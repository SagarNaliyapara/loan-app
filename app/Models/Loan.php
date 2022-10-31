<?php

namespace App\Models;

use App\Models\Enums\LoanStatus;
use App\Models\Interfaces\ILoan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model implements ILoan
{
    use HasFactory;

    protected $casts = [
        'status' => LoanStatus::class,
    ];

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }

    public function loanRepayments(): HasMany
    {
        return $this->hasMany(LoanRepayment::class);
    }
}
