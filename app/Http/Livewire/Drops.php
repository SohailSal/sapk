<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AccountGroup;
use App\Models\AccountType;

class Drops extends Component
{
    public $type;
    public $groups;
    public $group;

    public function render()
    {
        if($this->type) {
            $this->groups = AccountGroup::where('type_id', $this->type)->get();
        }
        return view('livewire.drops')
            ->withTypes(AccountType::orderBy('name')->get());
    }
}
