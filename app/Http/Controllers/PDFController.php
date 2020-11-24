<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\AccountGroup;
use App\Models\Entry;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use \Crypt;
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
        $entries = Entry::where('account_id',Crypt::decrypt($id))->where('company_id',session('company_id'))->get();
        $pdf = PDF::loadView('led', compact('entries'));
        return $pdf->stream('ledger.pdf');
    }
    
    public function rangeLedger(Request $request)
    {
        $start = $request->input('date_start');
        $end = $request->input('date_end');
        $account = $request->input('account_id');

        $entries = DB::table('documents')
            ->join('entries', 'documents.id', '=', 'entries.document_id')
            ->whereDate('documents.date', '>=', $start)
            ->whereDate('documents.date', '<=', $end)
            ->where('documents.company_id',session('company_id'))
            ->select('entries.account_id', 'entries.debit', 'entries.credit', 'documents.ref', 'documents.date', 'documents.description')
            ->where('entries.account_id','=',$account)
            ->get();

        $previous = Entry::whereDate('created_at','<',$start)->where('account_id','=',$account)->where('company_id',session('company_id'))->get();
        $acc = Account::where('id','=',$account)->where('company_id',session('company_id'))->first();
        $period = "From ".strval($start)." to ".strval($end);
        $pdf = PDF::loadView('range', compact('entries','previous','acc','period'));
        return $pdf->stream('ledger.pdf');
    }

    public function tb()
    {
        $accounts = Account::where('company_id',session('company_id'))->get();
        $pdf = PDF::loadView('tb', compact('accounts'));
        return $pdf->stream('tb.pdf');
    }        

    public function bs()
    {
        $pdf = PDF::loadView('bs');
        return $pdf->stream('bs.pdf');
    }        

    public function pl()
    {
        $pdf = PDF::loadView('pl');
        return $pdf->stream('pl.pdf');
    }        

    public function voucher($id)
    {
        $voucher = Document::where('id',Crypt::decrypt($id))->first();
        $pdf = PDF::loadView('voucher', compact('voucher'));
        return $pdf->stream('voucher.pdf');
    }        

}
