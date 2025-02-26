<?php

declare(strict_types=1);

namespace common\services;

use common\repositories\ConstructionSiteRepository;
use common\structures\PagedConstructionSites;
use yii\web\BadRequestHttpException;

class ConstructionSiteService
{
    public const int LIMIT_MAX = 100;

    public function getPagedSites(
        ?int $offset,
        ?int $limit,
    ): PagedConstructionSites {
        $repository = new ConstructionSiteRepository;
        $offset = $offset ?? $repository::OFFSET;

        $limit = $limit ?? $repository::LIMIT;
        if ($limit > self::LIMIT_MAX) {
            throw new BadRequestHttpException(
                "Requested ($limit) is too big, max is " . self::LIMIT_MAX,
            );
        }

        return new PagedConstructionSites(
            $repository->getAllPaged($offset, $limit),
            $repository->getAllPagedCount($offset, $limit),
            $offset,
            $limit,
        );
    }
}