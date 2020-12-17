<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DocumentType;

class DocTypes extends Component
{
    public $types, $name, $prefix, $at_id;
    public $ite=0;
    public $isOpen = 0;

    public function mount(){
        $this->name="";
    }

    public function render()
    {
        $this->prefix = "";
        if(strlen($this->name)>1 && strpos($this->name," ")){
            $words = explode(" ", $this->name);
            foreach ($words as $w) {
            $this->prefix .= $w[0];
            }
        }
        $this->types = DocumentType::where('company_id',session('company_id'))->get();
        return view('livewire.sa.doc-types');
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
        $this->name = '';
        $this->prefix = '';
        $this->at_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'prefix' => 'required',
        ]);

        DocumentType::updateOrCreate(['id' => $this->at_id], [
            'name' => $this->name,
            'prefix' => $this->prefix,
            'company_id' => session('company_id'),
        ]);

        session()->flash('message', 
            $this->at_id ? 'Voucher Type Updated Successfully.' : 'Voucher Type Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $type = DocumentType::where('id',$id)->where('company_id',session('company_id'))->first();
        $this->at_id = $id;
        $this->name = $type->name;
        $this->prefix = $type->prefix;
        $this->openModal();
    }

    public function delete($id)
    {
        DocumentType::where('id',$id)->where('company_id',session('company_id'))->first()->delete();
        session()->flash('message', 'Voucher Type Deleted Successfully.');
    }
}
