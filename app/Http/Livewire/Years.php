<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Year;

class Years extends Component
{
    public $years, $begin, $end, $company_id, $y_id;

    public function render()
    {
        $this->years = Year::where('company_id',session('company_id'))->get();
        return view('livewire.years');
    }

    public function create()
    {
    }

    private function resetInputFields(){
        $this->begin = null;
        $this->end = null;
        $this->company_id = '';
        $this->y_id = '';
    }

    public function store()
    {
        $this->validate([
            'begin' => 'required|date',
            'end' => 'required|date',
        ]);

        Year::updateOrCreate(['id' => $this->y_id], [
            'begin' => $this->begin,
            'end' => $this->end,
            'company_id' => session('company_id'),
        ]);

        session()->flash('message', 
            $this->y_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $year = Year::findOrFail($id);
        $this->y_id = $id;
        $this->begin = $year->begin;
        $this->end = $year->end;
    }

    public function delete($id)
    {
        Year::find($id)->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }
}
