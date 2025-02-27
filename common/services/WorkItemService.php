<?php

declare(strict_types=1);

namespace common\services;

use common\models\Employee;
use common\models\WorkItem;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class WorkItemService
{
    /**
     * @param int[] $allowedRoles
     *
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function getItemByEmployee(
        int $id,
        Employee $employee,
        array $allowedRoles = [Employee::ROLE_ADMIN],
    ): WorkItem {
        if (!in_array($employee->role, $allowedRoles)) {
            throw new ForbiddenHttpException("Not allowed.");
        }

        $workItem = WorkItem::findOne($id);
        if (!$workItem) {
            throw new NotFoundHttpException("This work item does not exist");
        }

        return $workItem;
    }
}