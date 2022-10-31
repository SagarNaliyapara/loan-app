<?php

namespace Tests\Feature;

use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use App\Models\LoanRepayment;
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
        LoanRepayment::factory()->count(4)->for($loan)->create();

        $this->getJson(route('loan.view', $loan))
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

    public function test_loan_repayment()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $loan = Loan::factory()->for($user)->create();
        LoanRepayment::factory()->count(4)->for($loan)->create();

        $this->postJson(route('loan.repayment', $loan), [
            'amount' => '250',
        ])
            ->assertSuccessful()
            ->assertJson([
                'message' => 'loan repayment successful',
            ]);

        $this->postJson(route('loan.repayment', $loan), [
            'amount' => '50',
        ])
            ->assertSuccessful()
            ->assertJson([
                'message' => 'loan repayment failed!',
            ]);
    }

    public function test_create_loan()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson(route('loan.create'), [
            'amount' => 1000,
            'term' => 4,
        ])
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Create a loan successful',
            ]);

        $this->assertDatabaseHas(Loan::class, [
            'user_id' => $user->id,
            'amount' => 1000,
            'term' => 4,
            'status' => LoanStatus::PENDING,
        ]);
    }

    public function test_approve_loan()
    {
        $userA = User::factory()->create([
            'role' => 'admin',
        ]);
        $userB = User::factory()->create();
        Sanctum::actingAs($userA);

        $loan = Loan::factory()->for($userB)->create();

        $this->assertDatabaseCount(LoanRepayment::class, 0);

        $this->postJson(route('loan.approve', $loan))
            ->assertSuccessful();

        $this->assertDatabaseCount(LoanRepayment::class, $loan->term);
    }
}
