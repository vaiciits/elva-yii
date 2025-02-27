<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\ConstructionSite;
use common\models\Employee;
use common\repositories\ConstructionSiteRepository;
use common\services\WorkItemService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ConstructionSiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function actionIndex(): string
    {
        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();
        if ($employee->role !== Employee::ROLE_ADMIN) {
            throw new ForbiddenHttpException();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => ConstructionSite::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
            ],
        );
    }

    public function actionView(int $id): string
    {
        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();
        $site = new ConstructionSiteRepository()->getOne($id);

        if ($site->access < $employee->access) {
            throw new ForbiddenHttpException("Your access level is not sufficient");
        }

        $workItems = new WorkItemService()->getItemsByEmployee($employee);

        return $this->render(
            'view',
            [
                'site' => $site,
                'workItems' => $workItems,
            ],
        );
    }
}