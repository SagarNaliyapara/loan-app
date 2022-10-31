<?php

namespace App\Http\Resources;

use App\Models\Interfaces\ILoanRepayment;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanRepaymentResource extends JsonResource implements ILoanRepayment
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'status' => $this->status,
        ];
    }
}
