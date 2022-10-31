<?php

namespace App\Models\Interfaces;

use App\Models\Enums\LoanRepaymentStatus;
use Carbon\Carbon;

/**
 * @property LoanRepaymentStatus $status
 * @property int $id
 * @property Carbon $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $loan_id
 * @property-read \App\Models\Loan $loan
 */
interface ILoanRepayment {}