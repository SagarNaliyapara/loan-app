<?php

namespace App\Http\Resources;

use App\Models\Interfaces\ILoan;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource implements ILoan
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'term' => $this->term,
            'status' => $this->status,
            'loan_repayments' => LoanRepaymentResource::collection($this->whenLoaded('loanRepayments')),
        ];
    }
}
