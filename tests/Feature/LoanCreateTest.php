<?php

namespace Tests\Feature;

use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use Tests\TestCase;

class LoanCreateTest extends TestCase
{
    /**
     * @dataProvider loanCreateInputs
     */
    public function test_create_loan_validations($value)
    {
        $this->postJson(route('loans.create'), [
            'amount' => $value,
            'term' => $value,
        ])
            ->assertJsonValidationErrors(['amount', 'term']);
    }

    public function loanCreateInputs(): array
    {
        return [
            [0],
            [0.9],
            [1.1],
        ];
    }

    public function test_create_loan_with_valid_inputs()
    {
        $this->postJson(route('loans.create'), [
            'amount' => 1,
            'term' => 2,
        ])
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'amount' => 1,
                    'term' => 2,
                    'status' => LoanStatus::PENDING->value,
                ],
            ]);

        $this->assertDatabaseHas(Loan::class, [
            'user_id' => $this->user->id,
            'amount' => 1,
            'term' => 2,
            'status' => LoanStatus::PENDING,
        ]);
    }
}