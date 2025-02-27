<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\WorkItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class WorkItemController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => WorkItem::find(),  // Your query
            'pagination' => [
                'pageSize' => 10, // Adjust page size as needed
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'id' => SORT_DESC,
            //     ],
            // ],
        ]);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
            ],
        );
    }
}