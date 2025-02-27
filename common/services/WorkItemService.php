<?php

declare(strict_types=1);

namespace common\services;

use common\models\ConstructionSite;
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

    /**
     * @return WorkItem[]
     */
    public function getItemsByEmployeeAndSiteId(
        Employee $employee,
        int $siteId,
    ): array {
        $query = WorkItem::find()
            ->leftJoin(
                ConstructionSite::tableName(),
                sprintf(
                    '%s.id = %s.construction_site_id',
                    ConstructionSite::tableName(),
                    WorkItem::tableName(),
                ),
            )
            ->where([
                'construction_site_id' => $siteId,
            ])
            ->andWhere([
                '>',
                'access',
                $employee->access,
            ]);

        if ($employee->isAdmin()) {
            return $query->all();
        }

        return $query
            ->andWhere([
                'employee_id' => $employee->id,
            ])
            ->all();
    }
}