<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\helpers\App;
use common\models\Employee;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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

    /**
     * @throws ForbiddenHttpException
     */
    public function actionCreate(): string|Response
    {
        $user = App::user();
        if (!$user->isAdmin()) {
            throw new ForbiddenHttpException("Not for you");
        }

        $employee = new Employee();

        if ($this->loadFromRequestAndSave($employee)) {
            return $this->redirect(['view', 'id' => $employee->id]);
        }

        return $this->render(
            'create',
            [
                'employee' => $employee,
            ],
        );
    }

    /**
     * @throws ForbiddenHttpException
     * @throws Exception
     */
    public function actionDelete(int $id): Response
    {
        $user = App::user();
        if (!$user->isAdmin()) {
            throw new ForbiddenHttpException("Not for you");
        }

        $site = Employee::findOne($id);

        if (!$site->delete()) {
            throw new Exception("Ooops");
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Handle POST data.
     */
    private function loadFromRequestAndSave(Employee $employee): bool
    {
        return $employee->load(Yii::$app->request->post()) && $employee->save();
    }
}