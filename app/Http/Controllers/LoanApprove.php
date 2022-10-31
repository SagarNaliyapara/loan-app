<?php

namespace App\Http\Controllers;

use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use App\Services\LoanService;
use Illuminate\Http\JsonResponse;

class LoanApprove extends Controller
{
    public function __construct(readonly private LoanService $loanService)
    {
    }

    public function __invoke(Loan $loan): JsonResponse
    {
        if ($loan->status !== LoanStatus::PENDING) {
            return response()->json([
                'message' => $loan->status === LoanStatus::APPROVED
                    ? 'Loan is already approved!'
                    : 'Loan is already paid and closed!',
            ], 422);
        }

        $this->loanService->approveLoan($loan);

        return response()->json([
            'message' => 'Loan has been marked as approved!',
        ]);
    }
}
