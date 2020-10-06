<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;

class Documents extends Component
{
    public $docs, $ref, $date, $description, $type_id, $at_id;
    public $ite=0;
    public $isOpen = 0;

    public function render()
    {
        $this->docs = Document::all();
        return view('livewire.sa.documents');
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

        Document::updateOrCreate(['id' => $this->at_id], [
            'ref' => $this->ref,
            'date' => $this->date,
            'description' => $this->description,
            'type_id' => $this->type_id,
        ]);

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
