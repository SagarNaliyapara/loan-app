<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class LoanService
{
    public function getLoanDetails(Loan $loan, User $user): Collection
    {
        return $loan
            ->where('user_id', $user->id)
            ->with('loanRepayments')
            ->first();
    }
}
