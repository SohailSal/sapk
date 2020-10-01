<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AccountGroup;

class AcGroups extends Component
{
    public $groups, $name, $type_id, $ag_id;
    public $ite=0;
    public $isOpen = 0;

    public function render()
    {
        $this->groups = AccountGroup::all();
        return view('livewire.asaccounting.ac-groups');
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
        $this->type_id = '';
        $this->ag_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'type_id' => 'required',
        ]);

        AccountGroup::updateOrCreate(['id' => $this->ag_id], [
            'name' => $this->name,
            'type_id' => $this->type_id,
        ]);

        session()->flash('message', 
            $this->ag_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $group = AccountGroup::findOrFail($id);
        $this->ag_id = $id;
        $this->name = $group->name;
        $this->type_id = $group->type_id;
        $this->openModal();
    }

    public function delete($id)
    {
        AccountGroup::find($id)->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }

}
