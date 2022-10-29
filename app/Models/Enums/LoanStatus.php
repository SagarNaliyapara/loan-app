<?php

namespace App\Models\Enums;

enum LoanStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case PAID = 'paid';
}
