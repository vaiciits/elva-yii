<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\Employee;
use common\repositories\WorkItemRepository;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class WorkItemController extends Controller
{
    public function actionIndex(): string
    {
        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();

        $dataProvider = new ActiveDataProvider([
            'query' => new WorkItemRepository()->getQueryByEmployee($employee),
            'pagination' => [
                'pageSize' => 10, // Adjust page size as needed
            ],
        ]);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
            ],
        );
    }
}