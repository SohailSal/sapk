<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Setting;

class Companies extends Component
{
    public $companies, $name, $address, $email, $web, $phone, $fiscal, $incorp, $co_id;
    public $ite=0;
    public $isOpen = 0;

    public function render()
    {
//        $this->companies = Company::all();
        return view('livewire.sa.companies',['docss' => auth()->user()->companies()->paginate(10)]);
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
            'address' => 'nullable',
            'email' => 'nullable|email:rfc,dns',
            'web' => 'nullable|active_url',
            'phone' => 'nullable|numeric',
            'fiscal' => 'required',
            'incorp' =>  'nullable|date',
        ]);

        $company = Company::updateOrCreate(['id' => $this->co_id], [
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'web' => $this->web,
            'phone' => $this->phone,
            'fiscal' => $this->fiscal,
            'incorp' => $this->incorp,
        ]);
        
        if(!$this->co_id){
            $company->users()->attach(auth()->user()->id);
            $cos = auth()->user()->companies;
            foreach($cos as $co){
                foreach($co->settings as $setting){
                    if(($setting->key =='active')&&($setting->value == 'yes'))
                    $setting->update(['value' => '']);
                }
            }
            $setting = Setting::create(['company_id' => $company->id, 'key' => 'active' , 'value' => 'yes']);
            session(['company_id' => $company->id ]);
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
