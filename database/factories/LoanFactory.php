<?php

namespace Database\Factories;

use App\Models\Enums\LoanStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::class,
            'amount' => '2500',
            'term' => '4',
            'status' => LoanStatus::PENDING->value,
        ];
    }
}
