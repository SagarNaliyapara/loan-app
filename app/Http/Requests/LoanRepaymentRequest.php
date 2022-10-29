<?php

namespace App\Http\Requests;

use App\Models\Loan;
use Illuminate\Foundation\Http\FormRequest;

class LoanRepaymentRequest extends FormRequest
{
    public function rules(): array
    {
        $loan = $this->route('loan');
        $emiAmount = $loan->amount / $loan->term;
        return [
            'amount' => 'required|min:'.$emiAmount.'|numeric',
        ];
    }
}
