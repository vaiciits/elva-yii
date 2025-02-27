<?php

declare(strict_types=1);

namespace common\services;

use common\models\Employee;
use common\models\WorkItem;

class EmployeeService
{
    /**
     * @return Employee[]
     */
    public function getAvailableEmployees(Employee $employee): array
    {
        if ($employee->role === Employee::ROLE_ADMIN) {
            return Employee::find()->all();
        }

        if ($employee->role === Employee::ROLE_MANAGER) {
            return Employee::find()
                ->where([
                    'id' => WorkItem::find()
                        ->select('employee_id')
                        ->where([
                            'construction_site_id' => array_column(
                                $employee->workItems,
                                'construction_site_id'
                            ),
                        ]),
                ])
                ->all();
        }

        return [];
    }
}