<?php

declare(strict_types=1);

namespace backend\helpers;

use common\models\Employee;
use Yii;

/**
 * App wide helper.
 */
class App
{
    /**
     * Get user identity as employee.
     *
     * @return Employee
     */
    public static function user(): Employee
    {
        /** @var Employee */
        return Yii::$app->user->getIdentity();
    }
}