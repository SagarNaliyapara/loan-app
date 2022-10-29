<?php

use App\Http\Controllers\LoanApprove;
use App\Http\Controllers\LoanCreate;
use App\Http\Controllers\LoanRepayment;
use App\Http\Controllers\LoanView;
use App\Models\Loan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('loans', LoanCreate::class)->name('loans.create');
    Route::get('loans/{loan}', LoanView::class)->name('loans.view')
        ->middleware('can:view,loan');
    Route::put('loans/{loan}/approve', LoanApprove::class)->name('loans.approve')
        ->middleware('can:update,loan');
    Route::post('loans/{loan}', LoanRepayment::class)->name('loans.repayment');
});
