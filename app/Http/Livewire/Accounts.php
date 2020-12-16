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
    public $number = null;

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
        $this->number = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'group_id' => 'required',
        ]);

        DB::transaction(function () {
            $account = Account::updateOrCreate(['id' => $this->ag_id], [
                'name' => $this->name,
                'group_id' => $this->group_id,
                'company_id' => session('company_id'),
            ]);

            if(! $this->ag_id){
                $this->snum($account);
                $account->update(['number' => $this->number]);
            }
        });

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

    function snum($account){
        
        if(! Account::where('id',$account->id)->where('company_id',session('company_id'))->first()){
            $this->number = $account->id . '/' .$account->group_id;
        } else {
            $this->number = $account->id . '-' .$account->group_id . '-' . $account->accountGroup->type_id . '-' . sprintf("%'.04d\n", ++$account->id);
        }
//        $num = 5;
//        $location = 'tree';
//        $format = 'There are %d monkeys in the %s';
//        echo sprintf($format, $num, $location);
//        sprintf("%'.09d\n", 123); // 000000123

    }
}
