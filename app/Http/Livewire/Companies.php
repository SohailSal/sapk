<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

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
        $this->address = ''; 
        $this->email = '';
        $this->web = '';
        $this->phone = '';
        $this->fiscal = '';
        $this->incorp = null;
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

        DB::transaction(function () {
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
        });

        session()->flash('message', 
            $this->co_id ? 'Company Updated Successfully.' : 'Company Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
        return redirect('group');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $this->co_id = $id;
        $this->name = $company->name;
        $this->address = $company->address;
        $this->email = $company->email;
        $this->web = $company->web;
        $this->phone = $company->phone;
        $this->fiscal = $company->fiscal;
        $this->incorp = $company->incorp;
        $this->openModal();
    }

    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $co = Company::findOrFail($id);
            foreach($co->settings as $setting){
                $setting->delete();
            }
            $co->users()->detach();
            $co->delete();
            if(auth()->user()->companies()){
                $newid = auth()->user()->companies()->latest()->first()->id;
                session(['company_id' => $newid ]);
                $newset = \App\Models\Setting::where('company_id',$newid)->where('key','active')->first();
                $newset->update(['value' => 'yes']);
            } else {
                session(['company_id' => '' ]);
            }
            session()->flash('message', 'Company Deleted Successfully.');
        });
        return redirect('dashboard');
    }
}
