<?php

namespace Tests\Feature;

use App\Models\Enums\LoanRepaymentStatus;
use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Tests\TestCase;

class LoanRepaymentTest extends TestCase
{
    public function test_loan_repayment_with_lower_amount()
    {
        $loan = Loan::factory()->for($this->user)->create([
            'amount' => 11,
            'term' => 2,
        ]);

        $this->postJson(route('loans.repayment', $loan), [
            'amount' => 4,
        ])
            ->assertJsonValidationErrors(['amount']);
    }

    public function test_loan_repayment()
    {
        $loan = Loan::factory()->for($this->user)->create([
            'amount' => 11,
            'term' => 2,
            'status' => LoanStatus::APPROVED,
        ]);

        $loanRepayments = LoanRepayment::factory()
            ->count(2)
            ->for($loan)
            ->sequence([
                'date' => now(),
            ], [
                'date' => now()->addWeek(),
            ])
            ->create();

        $this->postJson(route('loans.repayment', $loan), [
            'amount' => 6,
        ])
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Loan payment paid successfully!',
            ]);

        $this->assertEquals(LoanRepaymentStatus::PAID->value, $loanRepayments[0]->refresh()->status);
        $this->assertEquals(LoanRepaymentStatus::PENDING->value, $loanRepayments[1]->refresh()->status);
        $this->assertEquals(LoanStatus::APPROVED->value, $loan->refresh()->status->value);

        $this->postJson(route('loans.repayment', $loan), [
            'amount' => 6,
        ])
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Loan payment paid successfully!',
            ]);

        $this->assertEquals(LoanRepaymentStatus::PAID->value, $loanRepayments[0]->refresh()->status);
        $this->assertEquals(LoanRepaymentStatus::PAID->value, $loanRepayments[1]->refresh()->status);
        $this->assertEquals(LoanStatus::PAID->value, $loan->refresh()->status->value);
    }
}