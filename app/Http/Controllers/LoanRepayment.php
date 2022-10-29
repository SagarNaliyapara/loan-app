<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRepaymentRequest;
use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use App\Services\LoanService;

class LoanRepayment extends Controller
{
    public function __construct(readonly private LoanService $loanService)
    {
    }

    public function __invoke(LoanRepaymentRequest $request, Loan $loan)
    {
        if ($loan->status !== LoanStatus::APPROVED) {
            return response()->json([
                'message' => $loan->status === LoanStatus::PAID
                    ? 'Your loan has been paid already!'
                    : 'Your loan is not approved yet!',
            ]);
        }

        $this->loanService->loanRepayment($loan);
        return response()->json([
            'message' => 'Loan payment paid successfully!',
        ]);
    }
}
