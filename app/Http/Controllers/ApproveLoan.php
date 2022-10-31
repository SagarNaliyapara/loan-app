<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\LoanService;

class ApproveLoan extends Controller
{
    public function __construct(readonly private LoanService $loanService)
    {
    }

    public function __invoke(Loan $loan)
    {
        $this->loanService->appoveLoan($loan, auth()->user());
    }
}
