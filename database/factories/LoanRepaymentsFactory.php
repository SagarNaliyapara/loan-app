<?php

namespace Database\Factories;

use App\Models\Enums\LoanRepaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanRepaymentsFactory extends Factory
{
    public function definition()
    {
        return [
            'status' => LoanRepaymentStatus::PENDING->value,
        ];
    }
}
