<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Http\Resources\LoanResource;
use App\Services\LoanService;

class LoanCreate extends Controller
{
    public function __construct(readonly private LoanService $loanService)
    {
    }

    public function __invoke(LoanCreateRequest $request): LoanResource
    {
        $loan = $this->loanService->createLoan($request->validated(), auth()->user());

        return new LoanResource($loan);
    }
}
