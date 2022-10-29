<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\Loan;

class LoanView extends Controller
{
    public function __invoke(Loan $loan): LoanResource
    {
        return new LoanResource($loan->load('loanRepayments'));
    }
}
