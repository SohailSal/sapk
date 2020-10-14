<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Posts;
use App\Http\Livewire\AcTypes;
use App\Http\Livewire\AcGroups;
use App\Http\Livewire\Accounts;
use App\Http\Livewire\DocTypes;
use App\Http\Livewire\Documents;
use App\Http\Livewire\Entries;
use App\Http\Controllers\PDFController;

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
})->name('dashboard');

Route::get('post', Posts::class);
Route::view('customers','livewire.home');
Route::get('type', AcTypes::class);
Route::get('group', AcGroups::class);
Route::get('account', Accounts::class);
Route::get('doctype', DocTypes::class);
Route::get('doc', Documents::class);
Route::get('entry', Entries::class);

Route::get('create-pdf-file', [PDFController::class, 'index']);
Route::get('ledger/{id}', [PDFController::class, 'ledger']);
