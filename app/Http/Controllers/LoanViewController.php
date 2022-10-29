<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Services\loanService;

class LoanViewController extends Controller
{
    public function __construct(readonly private loanService $loanService)
    {
    }

    public function __invoke()
    {
        return LoanResource::collection($this->loanService->getLoanDetails());
    }
}
