<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AcTypes;
use App\Http\Livewire\AcGroups;
use App\Http\Livewire\Accounts;
use App\Http\Livewire\DocTypes;
use App\Http\Livewire\Documents;
use App\Http\Livewire\Entries;
use App\Http\Livewire\Companies;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\CloseYear;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('ch');

Route::get('type', AcTypes::class)->middleware('auth');
Route::get('group', AcGroups::class)->middleware('auth','ch');
Route::get('account', Accounts::class)->middleware('auth','ch','gr');
Route::get('doctype', DocTypes::class)->middleware('auth','ch');
Route::get('doc', Documents::class)->middleware('auth','ch','ck');
Route::get('entry', Entries::class)->middleware('auth','ch');
Route::get('company', Companies::class)->middleware('auth','ch');

Route::get('create-pdf-file', [PDFController::class, 'index'])->middleware('auth');
Route::get('ledger/{id}', [PDFController::class, 'ledger'])->middleware('auth');
Route::get('voucher/{id}', [PDFController::class, 'voucher'])->middleware('auth');
Route::get('tb', [PDFController::class, 'tb'])->middleware('auth');
Route::get('bs', [PDFController::class, 'bs'])->middleware('auth');
Route::get('pl', [PDFController::class, 'pl'])->middleware('auth');
Route::get('first-chart', [ChartController::class, 'index'])->middleware('auth');
Route::get('excel', [ExcelController::class, 'export'])->middleware('auth');

Route::get('choose', function () {
    return view('choose');
})->middleware('auth','co');

Route::get('/report', function () {
    return view('report');
})->middleware('auth','ch');

Route::get('generate', AcGroups::class)->middleware('auth','df');
Route::get('range', [PDFController::class, 'rangeLedger'])->middleware('auth');

Route::get('close', CloseYear::class)->middleware('auth');
