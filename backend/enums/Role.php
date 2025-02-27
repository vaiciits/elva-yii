<?php

declare(strict_types=1);

namespace backend\enums;

use common\models\Employee;

enum Role: int
{
    case ADMIN = Employee::ROLE_ADMIN;
    case MANAGER = Employee::ROLE_MANAGER;
    case EMPLOYEE = Employee::ROLE_EMPLOYEE;

    public static function uppercaseFirst(?int $role): string
    {
        return ucfirst(strtolower(self::tryFrom($role)->name ?? ''));
    }
}