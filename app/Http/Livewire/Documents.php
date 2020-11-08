<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Account;
use App\Models\Entry;
use Illuminate\Support\Carbon;

class Documents extends Component
{
    public $docs, $accounts, $ref, $date, $description, $type_id, $type, $types, $at_id;
    public $ite=0;
    public $isOpen = 0;
    public $account_id= [];
    public $debit=[];
    public $credit=[];
    public $inputs=[];
    public $i = 1;
    public $latest;
    public $diff, $dtotal, $ctotal;
    public $month, $year;

    protected $rules = [
        'diff' => 'gte:0|lte:0',
    ];

    public function mount(){
        $this->docs = Document::where('company_id',session('company_id'))->get();
        $this->types = DocumentType::where('company_id',session('company_id'))->get();
        $this->type_id = DocumentType::where('company_id',session('company_id'))->first()->id;
        $this->type = $this->types->where('id',$this->type_id)->first();
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
        array_push($this->debit ,'0');
        array_push($this->credit ,'0');
    }

    public function remove($i)
    {
        $j = $i+2;
        unset($this->inputs[$i]);
        unset($this->account_id[$j]);
        $this->debit[$j]=0;
        $this->credit[$j]=0;
 //       unset($this->debit[$j]);
  //      unset($this->credit[$j]);
//        $this->inputs = array_values($this->inputs);
 //       $this->account_id = array_values($this->account_id);
 //       $this->debit = array_values($this->debit);
 //       $this->credit = array_values($this->credit);
 //       $this->i = $this->i - 1;


//        $this->debit[$j]=0;
//        $this->credit[$j]=0;
    }

    public function render()
    {
        $this->docs = Document::where('company_id',session('company_id'))->get();
        $this->type = $this->types->where('id',$this->type_id)->first();
        if(count($this->docs->where('type_id',$this->type_id))){
        $lastref = Document::where('type_id',$this->type_id)->latest()->first()->ref;
        $expNum=explode('/', $lastref);
        $this->latest = $expNum[3];
        ++$this->latest;
        } else {
            $this->latest = 1;      // for first voucher. only works on fresh database starting from id=1 or else error in entries
        }
        $this->ref = $this->type->prefix . '/' . Carbon::today()->year . '/' . Carbon::today()->month . '/' .$this->latest;
        $this->total();
        return view('livewire.sa.documents',['docss'=>Document::where('company_id',session('company_id'))->paginate(10)]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->debit[0]='0';
        $this->debit[1]='0';
        $this->credit[0]='0';
        $this->credit[1]='0';
        $this->accounts = Account::where('company_id',session('company_id'))->get();
//        $this->type_id = $this->type->id;
//        $type=DocumentType::find($this->type_id);
        $this->date = Carbon::today()->toDateString();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->ref = '';
        $this->date = '';
        $this->description = '';
//        $this->type='';
        $this->at_id = '';
        $this->inputs = [];
        $this->account_id = [];
        $this->debit = [];
        $this->credit = [];
        $this->i=1;
    }

    public function store()
    {
        $this->validate([
            'ref' => 'required',
            'date' => 'required',
            'description' => 'required',
            'type_id' => 'required',
            'account_id.0' => 'required',
            'debit.0' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'credit.0' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'account_id.1' => 'required',
            'debit.1' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'credit.1' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'account_id.*' => 'required',
            'debit.*' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'credit.*' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $this->validate();

        $current = Document::create([
            'ref' => $this->ref,
            'date' => $this->date,
            'description' => $this->description,
            'type_id' => $this->type_id,
            'company_id' => session('company_id'),
        ]);

        foreach ($this->account_id as $key => $value) {
            Entry::create(['document_id' => $current->id, 'account_id' => $this->account_id[$key], 'debit' => $this->debit[$key], 'credit' => $this->credit[$key], 'company_id' => session('company_id')]);
        }

        session()->flash('message', 
            $this->at_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $doc = Document::findOrFail($id)->where('company_id',session('company_id'));
        $this->at_id = $id;
        $this->ref = $doc->ref;
        $this->date = $doc->date;
        $this->description = $doc->description;
        $this->type_id = $doc->type_id;
        $this->openModal();
    }

    public function delete($id)
    {
        $entries = Entry::where('document_id',$id)->where('company_id',session('company_id'))->get();
        foreach($entries as $entry){
            $entry->delete();
        }
        Document::find($id)->where('company_id',session('company_id'))->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }

    function total(){
        $dtotal=0;
        $ctotal=0;
        for($j=0;$j<count($this->debit);$j++){
            if($this->debit[$j]){
                $dtotal = $dtotal + $this->debit[$j];
            }
        }
        for($j=0;$j<count($this->credit);$j++){
            if($this->credit[$j]){
                $ctotal = $ctotal + $this->credit[$j];
            }
        }
        $this->dtotal = $dtotal;
        $this->ctotal = $ctotal;
        $this->diff = $this->dtotal - $this->ctotal;
    }
}
