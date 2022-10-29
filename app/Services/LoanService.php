<?php

namespace App\Services;

use App\Models\Enums\LoanRepaymentStatus;
use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LoanService
{
    public function createLoan($data, User $user): Loan
    {
        $data['user_id'] = $user->id;
        return Loan::query()->create(Arr::only($data, [
            'amount',
            'term',
            'user_id',
        ]))->refresh();
    }

    public function approveLoan(Loan $loan): void
    {
        $date = now();
        $now = now();

        DB::beginTransaction();
        try {
            $loan->update([
                'status' => LoanStatus::APPROVED,
            ]);

            $repayments = [];
            for ($i = 1; $i <= $loan->term; $i++) {
                $repayments[] = [
                    'loan_id' => $loan->id,
                    'date' => $date->addWeek()->copy(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            LoanRepayment::query()->insert($repayments);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function loanRepayment(Loan $loan): void
    {
        $loanRepayment = LoanRepayment::query()
            ->where('loan_id', $loan->id)
            ->where('status', LoanRepaymentStatus::PENDING->value)
            ->orderBy('date')
            ->first();

        $loanRepayment->update([
            'status' => LoanRepaymentStatus::PAID,
        ]);

        $loanRepaymentRemainingCount = LoanRepayment::query()
            ->where('loan_id', $loan->id)
            ->where('status', LoanRepaymentStatus::PENDING->value)
            ->count();

        if ($loanRepaymentRemainingCount === 0) {
            $loan->update([
                'status' => LoanStatus::PAID,
            ]);
        }
    }
}
