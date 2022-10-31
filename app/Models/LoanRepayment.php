<?php

namespace App\Models;

use App\Models\Interfaces\ILoanRepayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanRepayment extends Model implements ILoanRepayment
{
    use HasFactory;

    public function loan(): BelongsTo
    {
        return  $this->belongsTo(Loan::class);
    }
}
