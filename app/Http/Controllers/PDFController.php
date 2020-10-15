<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\Entry;
use PDF;

class PDFController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('testPDF', $data);
        return $pdf->stream('tutsmake.pdf');
    }

    public function ledger($id)
    {
        $entries = Entry::where('account_id',$id)->get();
        $pdf = PDF::loadView('led', compact('entries'));
        return $pdf->stream('ledger.pdf');
    }        

    public function tb()
    {
        $accounts = Account::all();
        $pdf = PDF::loadView('tb', compact('accounts'));
        return $pdf->stream('tb.pdf');
    }        
}
