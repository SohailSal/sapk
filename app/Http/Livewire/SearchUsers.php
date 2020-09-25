<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class SearchUsers extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search-users', [
            'users' => Post::where('title','like', '%'.$this->search.'%')->get(),
        ]);
    }
}
