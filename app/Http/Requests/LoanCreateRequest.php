<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => 'required|integer',
            'term' => 'required|integer',
        ];
    }
}
