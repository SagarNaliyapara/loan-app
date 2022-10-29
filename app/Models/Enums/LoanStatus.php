<?php

namespace App\Models\Enums;

enum LoanStatus
{
    case PENDING;
    case APPROVED;
    case PAID;
}