<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entry;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FirstExport;

class ExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new FirstExport, 'entries.xlsx');
    }

}
