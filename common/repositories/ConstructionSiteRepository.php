<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\ConstructionSite;

class ConstructionSiteRepository
{
    public const int OFFSET = 0;
    public const int LIMIT = 20;

    /**
     * @return ConstructionSite[]
     */
    public function getAllPaged(
        int $offset = self::OFFSET,
        int $limit = self::LIMIT,
    ): array {
        return ConstructionSite::find()
            ->offset($offset)
            ->limit($limit)
            ->all();
    }
}