<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;

class Customers extends Component
{
    public $customers, $name, $email, $customer_id;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function render()
    {
        $this->customers = Customer::all();
        return view('livewire.customers');
    }

    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
                'name.0' => 'required',
                'email.0' => 'required',
                'name.*' => 'required',
                'email.*' => 'required|email',
            ],
            [
                'name.0.required' => 'name field is required',
                'email.0.required' => 'email field is required',
	            'email.0.email' => 'The email must be a valid email address.',
                'name.*.required' => 'name field is required',
                'email.*.required' => 'email field is required',
                'email.*.email' => 'The email must be a valid email address.',
            ]
        );

        foreach ($this->name as $key => $value) {
            Customer::create(['name' => $this->name[$key], 'email' => $this->email[$key]]);
        }

        $this->inputs = [];

        $this->resetInputFields();

        session()->flash('message', 'Customers Created Successfully.');
    }
}