<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::redirect('/', '/NUEIP/accounts', 302);

Route::prefix('NUEIP')->group(function () {
    Route::get('/accounts', [AccountController::class, 'index'])->name('account.index');
    //Route::get('/account/create', [AccountController::class, 'create'])->name('account.create');
    //Route::get('/account/show', [AccountController::class, 'show'])->name('account.show');
    //Route::get('/account/edit/{id}', [AccountController::class, 'edit'])->name('account.edit');



});
#->middleware('auth');
