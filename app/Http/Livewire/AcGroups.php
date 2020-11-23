<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AccountGroup;
use App\Models\AccountType;
use Livewire\WithPagination;

class AcGroups extends Component
{
    use WithPagination;

    public $name, $type_id, $ag_id, $types;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.sa.ac-groups',['groups'=>AccountGroup::where('company_id',session('company_id'))->paginate(10)]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->types = AccountType::all();
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
            'company_id' => session('company_id'),
        ]);

        session()->flash('message', 
            $this->ag_id ? 'Account Group Updated Successfully.' : 'Account Group Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $group = AccountGroup::where('id',$id)->where('company_id',session('company_id'))->first();
        $this->ag_id = $id;
        $this->name = $group->name;
        $this->types = AccountType::all();
        $this->type_id = $group->type_id;
        $this->openModal();
    }

    public function delete($id)
    {
        AccountGroup::where('id',$id)->where('company_id',session('company_id'))->first()->delete();
        session()->flash('message', 'Account Group Deleted Successfully.');
    }

}
