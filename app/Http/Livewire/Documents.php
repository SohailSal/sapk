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
    public $docs, $accounts, $ref, $date, $description, $type_id, $at_id;
    public $ite=0;
    public $isOpen = 0;
    public $account_id= [];
    public $debit=[];
    public $credit=[];
    public $inputs=[];
    public $i = 1;
    public $latest;
    public $diff, $dtotal, $ctotal;

    public function mount(){
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
        $this->docs = Document::all();
        if(count($this->docs)){
        $this->latest = Document::latest()->first()->id;
        ++$this->latest;
        } else {
            $this->latest = 1;      // for first voucher. only works on fresh database starting from id=1 or else error in entries
        }

        $this->total();
        return view('livewire.sa.documents',['docss'=>Document::paginate(10)]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->debit[0]='0';
        $this->debit[1]='0';
        $this->credit[0]='0';
        $this->credit[1]='0';
        $this->type_id = 1;
        $this->accounts = Account::all();
        $type=DocumentType::find($this->type_id);
        $this->date = Carbon::today()->toDateString();
        $this->ref = $type->prefix . '/' . $this->latest;
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
        $this->type_id='';
        $this->at_id = '';
        $this->inputs = [];
        $this->account_id = [];
        $this->debit = [];
        $this->credit = [];
        $this->i=1;
        $diff=0;
        $dtotal=0;
        $ctotal=0;
    }

    public function store()
    {
        $this->validate([
            'ref' => 'required',
            'date' => 'required',
            'description' => 'required',
            'type_id' => 'required',
        ]);

        Document::create([
            'ref' => $this->ref,
            'date' => $this->date,
            'description' => $this->description,
            'type_id' => $this->type_id,
        ]);

        foreach ($this->account_id as $key => $value) {
            Entry::create(['document_id' => $this->latest, 'account_id' => $this->account_id[$key], 'debit' => $this->debit[$key], 'credit' => $this->credit[$key]]);
        }

        session()->flash('message', 
            $this->at_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $doc = Document::findOrFail($id);
        $this->at_id = $id;
        $this->ref = $doc->ref;
        $this->date = $doc->date;
        $this->description = $doc->description;
        $this->type_id = $doc->type_id;
        $this->openModal();
    }

    public function delete($id)
    {
        $entries = Entry::where('document_id',$id)->get();
        foreach($entries as $entry){
            $entry->delete();
        }
        Document::find($id)->delete();
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
