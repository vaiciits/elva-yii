<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\Employee;
use common\models\WorkItem;
use yii\db\ActiveQuery;

class WorkItemRepository
{
    /**
     * Get query for accessible work items.
     */
    public function getQueryByEmployee(Employee $employee): ActiveQuery
    {
        $query = WorkItem::find();

        switch ($employee->role) {
            case Employee::ROLE_ADMIN:
                // Can access everything.
                break;
            case Employee::ROLE_MANAGER:
                $siteIds = array_column($employee->workItems, 'construction_site_id');
                $query = $query->where([
                    'OR',
                    ['construction_site_id' => $siteIds],
                    ['employee_id' => $employee->id],
                ]);
                break;
            case Employee::ROLE_EMPLOYEE:
                $query = $query->where(['employee_id' => $employee->id]);
                break;
        }

        return $query;
    }
}