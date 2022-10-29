<?php

namespace Tests\Feature;

use App\Models\Enums\LoanStatus;
use App\Models\Enums\UserRole;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Tests\TestCase;

class LoanApproveTest extends TestCase
{
    public function test_loan_approve_with_normal_user()
    {
        $loan = Loan::factory()->for($this->user)->create();

        $this->putJson(route('loans.approve', $loan))
            ->assertForbidden();
    }

    public function test_loan_approve_with_admin_user()
    {
        $this->user->update([
            'role' => UserRole::ADMIN,
        ]);

        $this->user->refresh();
        $loan = Loan::factory()->for($this->user)->create([
            'status' => LoanStatus::PENDING,
            'term' => 3,
            'amount' => 12,
        ]);

        $this->putJson(route('loans.approve', $loan))
            ->assertSuccessful()
            ->assertJson([
                'message' => 'Loan has been marked as approved!',
            ]);

        $this->assertDatabaseHas(Loan::class, [
            'id' => $loan->id,
            'status' => LoanStatus::APPROVED,
        ]);

        $this->assertDatabaseCount(LoanRepayment::class, 3);

        $this->assertDatabaseHas(LoanRepayment::class, [
            'loan_id' => $loan->id,
            'date' => now()->addWeek()->toDateString(),
        ]);

        $this->assertDatabaseHas(LoanRepayment::class, [
            'loan_id' => $loan->id,
            'date' => now()->addWeeks(2)->toDateString(),
        ]);

        $this->assertDatabaseHas(LoanRepayment::class, [
            'loan_id' => $loan->id,
            'date' => now()->addWeeks(3)->toDateString(),
        ]);
    }
}