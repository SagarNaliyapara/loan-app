<?php

namespace Database\Factories;

use App\Models\Enums\LoanRepaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanRepaymentFactory extends Factory
{
    public function definition()
    {
        return [
            'status' => LoanRepaymentStatus::PENDING->value,
            'repayment_date' => now(),
        ];
    }
}
