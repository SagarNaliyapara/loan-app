<?php

namespace App\Models\Interfaces;

use App\Models\Enums\LoanStatus;
use Carbon\Carbon;

/**
 * @property LoanStatus $status
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property int $term
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LoanRepayment[] $loanRepayments
 * @property-read int $loan_repayments_count
 * @property-read \App\Models\User $user
 */
interface ILoan {}