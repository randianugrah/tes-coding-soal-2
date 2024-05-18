<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TransactionController::class, 'index'])->name('transaction');
Route::resource('transaction', TransactionController::class);
Route::resource('register', CustomerController::class);
Route::resource('voucher', VoucherController::class);
Route::post('check-voucher', [VoucherController::class, 'checkVoucher'])->name('voucher.checkVoucher');