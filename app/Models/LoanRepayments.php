<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanRepayments extends Model
{
    use HasFactory;

    public function loan(): BelongsTo
    {
        return  $this->belongsTo(Loan::class);
    }
}
