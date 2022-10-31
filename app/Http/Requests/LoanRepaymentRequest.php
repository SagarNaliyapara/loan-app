<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRepaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => 'required|integer',
        ];
    }
}
