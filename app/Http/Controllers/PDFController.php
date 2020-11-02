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
            'title' => 'Welcome to sa.pk',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('testPDF', $data);
        return $pdf->stream('make.pdf');
    }

    public function ledger($id)
    {
        $entries = Entry::where('account_id',$id)->where('company_id',session('company_id'))->get();
        $pdf = PDF::loadView('led', compact('entries'));
        return $pdf->stream('ledger.pdf');
    }        

    public function tb()
    {
        $accounts = Account::where('company_id',session('company_id'))->get();
        $pdf = PDF::loadView('tb', compact('accounts'));
        return $pdf->stream('tb.pdf');
    }        
}
