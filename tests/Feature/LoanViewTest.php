<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\User;
use Tests\TestCase;

class LoanViewTest extends TestCase
{
    public function test_view_loan_with_different_author()
    {
        $user = User::factory()->create();
        $loan = Loan::factory()->for($user)->create();

        $this->getJson(route('loans.view', $loan))
            ->assertForbidden();
    }

    public function test_view_loan_with_author()
    {
        $loan = Loan::factory()->for($this->user)->create();
        LoanRepayment::factory()
            ->count(4)
            ->for($loan)
            ->sequence([
                'date' => now(),
            ], [
                'date' => now()->addWeek(),
            ], [
                'date' => now()->addWeeks(2),
            ], [
                'date' => now()->addWeeks(3),
            ])
            ->create();

        $this->getJson(route('loans.view', $loan))
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'amount',
                    'term',
                    'status',
                    'loan_repayments' => [
                        [
                            'id',
                            'date',
                            'status',
                        ],
                    ],
                ],
            ]);
    }
}