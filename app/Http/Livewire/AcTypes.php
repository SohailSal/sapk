<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AccountType;

class AcTypes extends Component
{
    public $types, $name, $at_id;
    public $ite=0;
    public $isOpen = 0;

    public function render()
    {
        $this->types = AccountType::all();
        return view('livewire.asaccounting.actypes');
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
        $this->at_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        AccountType::updateOrCreate(['id' => $this->at_id], [
            'name' => $this->name,
        ]);

        session()->flash('message', 
            $this->at_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $type = AccountType::findOrFail($id);
        $this->at_id = $id;
        $this->name = $type->name;
        $this->openModal();
    }

    public function delete($id)
    {
        AccountType::find($id)->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }
}