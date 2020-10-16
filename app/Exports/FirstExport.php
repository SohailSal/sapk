<?php 

namespace App\Exports;

use App\Models\Entry;
use Maatwebsite\Excel\Concerns\FromCollection;

class FirstExport implements FromCollection
{
    public function collection()
    {
        return Entry::all();
    }
}