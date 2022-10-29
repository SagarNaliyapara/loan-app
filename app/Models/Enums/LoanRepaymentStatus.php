<?php

namespace App\Models\Enums;

enum LoanRepaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
}
