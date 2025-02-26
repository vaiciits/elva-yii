<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\ConstructionSite;

class ConstructionSiteRepository
{
    /**
     * @return ConstructionSite[]
     */
    public function getAllPaged(int $offset = 0, int $limit = 20): array
    {
        return ConstructionSite::find()
            ->offset($offset)
            ->limit($limit)
            ->all();
    }
}