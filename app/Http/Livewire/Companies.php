<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;

class Companies extends Component
{
    public $companies, $name, $co_id;
    public $ite=0;
    public $isOpen = 0;

    public function render()
    {
        $this->companies = Company::all();
        return view('livewire.sa.companies',['docss' => Company::paginate(10)]);
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
        $this->co_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $company = Company::updateOrCreate(['id' => $this->co_id], [
            'name' => $this->name,
        ]);
        
        if(!$this->co_id){
            $company->users()->attach(auth()->user()->id);
        }

        session()->flash('message', 
            $this->co_id ? 'Company Updated Successfully.' : 'Company Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $this->co_id = $id;
        $this->name = $company->name;
        $this->openModal();
    }

    public function delete($id)
    {
        Company::find($id)->delete();
        session()->flash('message', 'Company Deleted Successfully.');
    }
}
