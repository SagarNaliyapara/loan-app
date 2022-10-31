<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Services\LoanService;

class LoanController extends Controller
{
    public function __construct(readonly private LoanService $loanService)
    {
    }

    public function __invoke(LoanCreateRequest $request)
    {
        $data = $request->validated();
        $this->loanService->createLoan($data, auth()->user());

        return response()->json([
            'message' => 'Create a loan successful',
        ]);
    }
}
