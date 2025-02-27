<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\helpers\App;
use common\models\Employee;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class EmployeeController extends Controller
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
        $user = App::user();
        if ($user->role !== Employee::ROLE_ADMIN) {
            throw new ForbiddenHttpException();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Employee::find(),
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

    /**
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $user = App::user();
        if (!$user->isAdmin()) {
            throw new ForbiddenHttpException("Not for you");
        }

        $employee = Employee::findOne($id);
        if (!$employee) {
            throw new NotFoundHttpException('Wrong id');
        }

        return $this->render(
            'view',
            [
                'employee' => $employee,
            ],
        );
    }
}