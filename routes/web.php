<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Posts;
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

Route::get('post', Posts::class);
Route::view('customers','livewire.home');
Route::get('type', AcTypes::class);
Route::get('group', AcGroups::class)->middleware('ch');
Route::get('account', Accounts::class)->middleware('ch','gr');
Route::get('doctype', DocTypes::class)->middleware('ch');
Route::get('doc', Documents::class)->middleware('ch','ck');
Route::get('entry', Entries::class)->middleware('ch');
Route::get('company', Companies::class)->middleware('ch');

Route::get('create-pdf-file', [PDFController::class, 'index']);
Route::get('ledger/{id}', [PDFController::class, 'ledger']);
Route::get('voucher/{id}', [PDFController::class, 'voucher']);
Route::get('tb', [PDFController::class, 'tb']);
Route::get('bs', [PDFController::class, 'bs']);
Route::get('pl', [PDFController::class, 'pl']);
Route::get('first-chart', [ChartController::class, 'index']);
Route::get('excel', [ExcelController::class, 'export']);

Route::get('choose', function () {
    return view('choose');
})->middleware('co');

Route::get('/report', function () {
    return view('report');
})->middleware('ch');

Route::get('generate', AcGroups::class)->middleware('df');
Route::get('range', [PDFController::class, 'rangeLedger']);

Route::get('close', CloseYear::class);
