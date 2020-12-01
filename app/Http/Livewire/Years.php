<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Year;
use Illuminate\Support\Carbon;

class Years extends Component
{
    public $years, $begin, $end, $company_id, $y_id;
    public $isOpen = 0;

    public function render()
    {
        $this->years = Year::where('company_id',session('company_id'))->get();
        return view('livewire.years');
    }

    public function create()
    {
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
        $this->begin = null;
        $this->end = null;
        $this->company_id = '';
        $this->y_id = '';
    }

    public function store()
    {
 /*       $this->validate([
            'begin' => 'required|date',
            'end' => 'required|date',
        ]);
*/
        if(!$this->y_id){
            $previous = Year::where('company_id',session('company_id'))->latest()->first();
            $begin = explode('-', $previous->begin);
            $end = explode('-', $previous->end);
            $begin[0]++;
            $end[0]++;
            $newBegin = implode('-',$begin);
            $newEnd = implode('-',$end);
            Year::create([
                'begin' => $newBegin,
                'end' => $newEnd,
                'company_id' => session('company_id'),
            ]);
        } else {
            $year = Year::findOrFail($this->y_id);
            $year->update(['begin' => $this->begin, 'end' => $this->end]);
        }
        session()->flash('message',  $this->y_id ? 'Company Updated Successfully.' : 'Company Created Successfully.');

        $this->resetInputFields();
        $this->closeModal();
    }

    public function edit($id)
    {
        $year = Year::findOrFail($id);
        $this->y_id = $id;
        $this->begin = $year->begin;
        $this->end = $year->end;
        $this->openModal();
    }

    public function delete($id)
    {
        Year::find($id)->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }
}
