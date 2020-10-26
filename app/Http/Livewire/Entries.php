<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;

class Entries extends Component
{
    public $entries, $document_id, $account_id, $debit, $credit, $at_id;
    public $ite=0;
    public $isOpen = 0;

    public function render()
    {
        $this->entries = Entry::all();
        return view('livewire.sa.entries');
    }

    public function create()
    {
        $this->resetInputFields();
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
        $this->document_id = '';
        $this->account_id = '';
        $this->debit = '';
        $this->credit='';
        $this->at_id = '';
    }

    public function store()
    {
        $this->validate([
            'document_id' => 'required',
            'account_id' => 'required',
            'debit' => 'required',
            'credit' => 'required',
        ]);

        Entry::updateOrCreate(['id' => $this->at_id], [
            'document_id' => $this->document_id,
            'account_id' => $this->account_id,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'company_id' => session('company_id'),
        ]);

        session()->flash('message', 
            $this->at_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $entry = Entry::findOrFail($id);
        $this->at_id = $id;
        $this->document_id = $entry->document_id;
        $this->account_id = $entry->account_id;
        $this->debit = $entry->debit;
        $this->credit = $entry->credit;
        $this->openModal();
    }

    public function delete($id)
    {
        Entry::find($id)->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }
}
