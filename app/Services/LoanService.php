<?php

namespace App\Services;

use App\Models\Enums\LoanRepaymentStatus;
use App\Models\Enums\LoanStatus;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class LoanService
{
    public function createLoan($data, User $user): Loan
    {
        $data['user_id'] = $user->id;
        return Loan::query()->create($data);
    }

    public function getLoanDetails(Loan $loan, User $user): Collection
    {
        return $loan
            ->where('user_id', $user->id)
            ->with('loanRepayments')
            ->first();
    }

    public function appoveLoan(Loan $loan, User $user): bool
    {
        $date = Carbon::now();

        if ($user->role == 'admin') {
            $loan->update([
                'status' => LoanStatus::APPROVED,
            ]);

            for ($i = 0; $i < $loan->term; $i++) {
                $date = $date->addDays(7);

                LoanRepayment::query()->create([
                    'loan_id' => $loan->id,
                    'repayment_date' => $date,
                ]);
            }
            return true;
        }
        return false;
    }

    public function loanRepayment($data, Loan $loan): bool
    {
        $loanAmount = $loan->amount / $loan->term;
        if ($data['amount'] >= $loanAmount) {
            $loanRepayment = LoanRepayment::query()
                ->where('loan_id', $loan->id)
                ->where('status', LoanRepaymentStatus::PENDING->value)
                ->firstOrFail();

            $loanRepayment == null ?
                $loan->update([
                    'status' => LoanStatus::PAID,
                ])
                :
                LoanRepayment::query()
                    ->where('id', $loanRepayment->id)
                    ->update([
                        'status' => LoanRepaymentStatus::PAID,
                    ]);

            return true;
        }
        return false;
    }
}
