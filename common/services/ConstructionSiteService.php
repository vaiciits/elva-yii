<?php

declare(strict_types=1);

namespace common\services;

use common\models\ConstructionSite;
use common\repositories\ConstructionSiteRepository;
use common\structures\PagedConstructionSites;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ConstructionSiteService
{
    public const int LIMIT_MAX = 100;

    public function getSite(int $id): ?ConstructionSite
    {
        $repository = new ConstructionSiteRepository;

        $site = $repository->getOne($id);
        if (null === $site) {
            throw new NotFoundHttpException();
        }

        return $site;
    }

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