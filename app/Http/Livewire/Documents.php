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
    public $inputs = [];
    public $i = 1;
    public $latest;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        $j = $i+2;
        unset($this->inputs[$i]);
        unset($this->account_id[$j]);
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

        for($j=0;$j<count($this->debit);$j++){
            if($this->debit[$j] > 0){
                $this->credit[$j] = 0;
            }
        }
        for($j=0;$j<count($this->credit);$j++){
            if($this->credit[$j] > 0){
                $this->debit[$j] = 0;
            }
        }

        return view('livewire.sa.documents');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->type_id = 1;
        $this->accounts = Account::all();
        $type=DocumentType::find($this->type_id);
        $this->date = Carbon::today()->toDateString();
        $this->ref = $type->prefix . '/' . $this->latest;
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

        $this->inputs = [];
        $this->account_id = [];
        $this->debit = [];
        $this->credit = [];

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
        Document::find($id)->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }
}
