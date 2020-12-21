<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\AccountGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
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
            } else {
                $this->snume($account);
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
        $ty = $account->accountGroup->accountType;
        $grs = $ty->accountGroups->where('company_id',session('company_id'));
        $grnum = count($grs);
        $grindex = 1;
        $grselindex = 0;
        $grsel = null;
//        $grcol = new Collection();
        foreach($grs as $gr){
//            $grcol->put($gr->name,$grindex);
            if($gr->name == $account->accountGroup->name){
                $grselindex = $grindex;
                $grsel = $gr;
            }
            ++$grindex;
        }
        if(count($grsel->accounts) == 1){
            $this->number = $ty->id . sprintf("%'.03d", $grselindex) . sprintf("%'.03d", 1);
        } else {
            $lastac = Account::orderBy('id', 'desc')->where('company_id',session('company_id'))->where('group_id',$grsel->id)->skip(1)->first()->number;
            $lastst = Str::substr($lastac, 4, 3);
            $this->number = $ty->id . sprintf("%'.03d", $grselindex) . sprintf("%'.03d", ++$lastst);
        }

    }

    function snume($account){
        $ty = $account->accountGroup->accountType;
        $grs = $ty->accountGroups->where('company_id',session('company_id'));
        $grindex = 1;
        $grselindex = 0;
        $grsel = null;
        foreach($grs as $gr){
            if($gr->name == $account->accountGroup->name){
                $grselindex = $grindex;
                $grsel = $gr;
            }
            ++$grindex;
        }
        if(count($grsel->accounts) == 1){
            $this->number = $ty->id . sprintf("%'.03d", $grselindex) . sprintf("%'.03d", 1);
        } else {
            $lastac = Account::orderBy('id', 'desc')->where('company_id',session('company_id'))->where('group_id',$grsel->id)->skip(1)->first()->number;
            $lastst = Str::substr($lastac, 4, 3);
            $this->number = $ty->id . sprintf("%'.03d", $grselindex) . sprintf("%'.03d", ++$lastst);
        }

    }

}
