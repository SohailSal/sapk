<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\AccountGroup;

class Accounts extends Component
{
    public $groups, $name, $group_id, $ag_id, $accounts;
    public $ite=0;
    public $isOpen = 0;

    public function render()
    {
        $this->accounts = Account::all();
        return view('livewire.sa.accounts');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->groups = AccountGroup::all();
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
        $this->group_id = '';
        $this->ag_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'group_id' => 'required',
        ]);

        Account::updateOrCreate(['id' => $this->ag_id], [
            'name' => $this->name,
            'group_id' => $this->group_id,
        ]);

        session()->flash('message', 
            $this->ag_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $this->ag_id = $id;
        $this->name = $account->name;
        $this->groups = AccountGroup::all();
        $this->group_id = $account->group_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Account::find($id)->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }
}
