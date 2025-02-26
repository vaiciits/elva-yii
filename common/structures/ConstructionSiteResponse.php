<?php

declare(strict_types=1);

namespace common\structures;

use common\models\ConstructionSite;
use common\models\Employee;
use JsonSerializable;

class ConstructionSiteResponse implements JsonSerializable
{
    public function __construct(
        private ConstructionSite $record,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            ...$this->record->toArray(),
            'access_missing' => array_map(
                fn(Employee $employee) => $employee->toArray(),
                $this->record->employeesWithMissingAccess,
            ),
        ];
    }
}