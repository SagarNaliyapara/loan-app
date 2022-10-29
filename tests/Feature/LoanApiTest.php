<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\LoanRepayments;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoanApiTest extends TestCase
{
    public function test_loan_view_details()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $loan = Loan::factory()->for($user)->create();
        LoanRepayments::factory()->count(4)->for($loan)->create();

        $this->getJson(route('loan.view'))
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'amount',
                        'term',
                        'status',
                        'loan_repayments',
                    ],
                ],
            ])
            ->assertJsonCount(1, 'data');
    }
}
