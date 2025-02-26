<?php

declare(strict_types=1);

namespace common\services;

use common\factories\ConstructionSiteFactory;
use common\repositories\ConstructionSiteRepository;
use common\structures\ConstructionSiteResponse;
use common\structures\PagedConstructionSites;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ConstructionSiteService
{
    public const int LIMIT_MAX = 100;

    /**
     * @throws NotFoundHttpException
     */
    public function getSite(int $id): ConstructionSiteResponse
    {
        $repository = new ConstructionSiteRepository;

        $site = $repository->getOne($id);
        if (null === $site) {
            throw new NotFoundHttpException();
        }

        return new ConstructionSiteFactory()->createFromActiveRecord($site);
    }

    /**
     * @throws BadRequestHttpException
     */
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