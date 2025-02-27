<?php

declare(strict_types=1);

namespace backend\controllers;

use common\services\ConstructionSiteService;
use common\structures\ConstructionSiteResponse;
use common\structures\PagedConstructionSites;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

class ConstructionSitesController extends Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        $before = parent::beforeAction($action);

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $before;
    }

    public function actionIndex(
        ?int $offset = null,
        ?int $limit = null,
    ): PagedConstructionSites {
        return new ConstructionSiteService()->getPagedSites($offset, $limit);
    }

    public function actionGet(int $id): ConstructionSiteResponse
    {
        return new ConstructionSiteService()->getSite($id);
    }
}