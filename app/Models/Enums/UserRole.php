<?php

namespace App\Models\Enums;

enum UserRole: string
{
    case USER = 'user';
    case ADMIN = 'admin';
}
