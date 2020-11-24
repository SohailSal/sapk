<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Entries extends Component
{
    use WithPagination;

    public $document_id, $account_id, $debit, $credit, $at_id;
    public $isOpen = 0;
    public $search1 = '';
    public $search2 = '';
    public $search3 = '';

    public function mount(){
        $str1 = Carbon::today()->year . '-' . Carbon::today()->month . '-' . Carbon::today()->day;
        $this->search2 = strval($str1);
        $this->search3 = strval($str1);
    }

    public function render()
    {
        $entries = DB::table('entries')
        ->join('documents', 'documents.id', '=', 'entries.document_id')
        ->whereDate('documents.date', '>=', $this->search2)
        ->whereDate('documents.date', '<=', $this->search3)
        ->where('documents.company_id',session('company_id'))
        ->select('entries.id','entries.account_id', 'entries.debit', 'entries.credit', 'documents.ref', 'documents.date', 'documents.description')
        ->where('entries.account_id','=',$this->search1)
        ->paginate(10);

        return view('livewire.sa.entries',['entries' => $entries]);
//        return view('livewire.sa.entries',['entries'=>Entry::where('company_id',session('company_id'))->where('id',$this->search1)->where('date','>=',$this->search2)->where('date','<=',$this->search3)->paginate(10)]);
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
        $this->document_id = '';
        $this->account_id = '';
        $this->debit = '';
        $this->credit='';
        $this->at_id = '';
    }

    public function store()
    {
        $this->validate([
            'document_id' => 'required',
            'account_id' => 'required',
            'debit' => 'required',
            'credit' => 'required',
        ]);

        Entry::updateOrCreate(['id' => $this->at_id], [
            'document_id' => $this->document_id,
            'account_id' => $this->account_id,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'company_id' => session('company_id'),
        ]);

        session()->flash('message', 
            $this->at_id ? 'Record Updated Successfully.' : 'Record Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $entry = Entry::where('id',$id)->where('company_id',session('company_id'))->first();
        $this->at_id = $id;
        $this->document_id = $entry->document_id;
        $this->account_id = $entry->account_id;
        $this->debit = $entry->debit;
        $this->credit = $entry->credit;
        $this->openModal();
    }

    public function delete($id)
    {
        Entry::where('id',$id)->where('company_id',session('company_id'))->first()->delete();
        session()->flash('message', 'Record Deleted Successfully.');
    }
}
