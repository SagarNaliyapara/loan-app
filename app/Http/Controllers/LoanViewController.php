<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\Loan;
use App\Services\LoanService;

class LoanViewController extends Controller
{
    public function __construct(readonly private LoanService $loanService)
    {
    }

    public function __invoke(Loan $loan)
    {
        return new LoanResource($this->loanService->getLoanDetails($loan, auth()->user()));
    }
}
