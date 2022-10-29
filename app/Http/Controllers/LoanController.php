<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Models\Loan;

class LoanController extends Controller
{
    public function create(LoanCreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        return Loan::query()->create($data);
    }
}
