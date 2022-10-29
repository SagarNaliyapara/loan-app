<?php

namespace App\Policies;

use App\Models\Enums\UserRole;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Loan $loan): bool
    {
        return $user->role === UserRole::ADMIN->value || $loan->user_id === $user->id;
    }

    public function update(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }
}
