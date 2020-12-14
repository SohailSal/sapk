<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\AccountGroup;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Accounts extends Component
{
    use WithPagination;

    public $groups, $name, $group_id, $ag_id;
    public $isOpen = 0;
    public $search = '';
    public $search2 = '';

    public function render()
    {
        $accounts = DB::table('accounts')
        ->join('account_groups', 'account_groups.id', '=', 'accounts.group_id')
        ->where('account_groups.company_id',session('company_id'))
        ->where('account_groups.name','like','%' . $this->search2 . '%')
        ->select('accounts.id','accounts.number', 'accounts.name', 'account_groups.name as groupName')
        ->where('accounts.name','like','%' . $this->search . '%')
        ->paginate(10);

        return view('livewire.sa.accounts',['accounts' => $accounts]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->groups = AccountGroup::where('company_id',session('company_id'))->get();
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
            'company_id' => session('company_id'),
        ]);

        session()->flash('message', 
            $this->ag_id ? 'Account Updated Successfully.' : 'Account Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $account = Account::where('id',$id)->where('company_id',session('company_id'))->first();
        $this->ag_id = $id;
        $this->name = $account->name;
        $this->groups = AccountGroup::where('company_id',session('company_id'))->get();
        $this->group_id = $account->group_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Account::where('id',$id)->where('company_id',session('company_id'))->first()->delete();
        session()->flash('message', 'Account Deleted Successfully.');
    }
}
