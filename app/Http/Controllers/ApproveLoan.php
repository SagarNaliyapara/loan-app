<?php

namespace App\Http\Controllers;

use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use Illuminate\Http\Request;

class ApproveLoan extends Controller
{
    public function __invoke(Loan $loan, Request $request)
    {
        $loan->update([
            'status' => LoanStatus::APPROVED,
        ]);
    }
}
