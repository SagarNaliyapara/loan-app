<?php

namespace App\Services;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;

class loanService
{
    public function getLoanDetails(): Collection
    {
        return Loan::query()
            ->where('user_id', auth()->id())
            ->with('loanRepayments')
            ->get();
    }
}
