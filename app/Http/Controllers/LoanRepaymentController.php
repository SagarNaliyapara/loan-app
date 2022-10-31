<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRepaymentRequest;
use App\Models\Loan;
use App\Services\LoanService;

class LoanRepaymentController extends Controller
{
    public function __construct(readonly private LoanService $loanService)
    {
    }

    public function __invoke(LoanRepaymentRequest $request, Loan $loan)
    {
        $data = $request->validated();

        if ($this->loanService->loanRepayment($data, $loan)) {
            return response()->json([
                'message' => 'loan repayment successful',
            ]);
        }
        return response()->json([
            'message' => 'loan repayment failed!',
        ]);
    }
}
