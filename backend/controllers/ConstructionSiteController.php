<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\helpers\App;
use common\models\ConstructionSite;
use common\models\Employee;
use common\repositories\ConstructionSiteRepository;
use common\services\WorkItemService;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

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
        $employee = App::user();
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

    /**
     * @throws ForbiddenHttpException
     */
    public function actionView(int $id): string
    {
        $employee = App::user();
        $site = new ConstructionSiteRepository()->getOne($id);

        if ($site->access < $employee->access) {
            throw new ForbiddenHttpException("Your access level is not sufficient");
        }

        $workItems = new WorkItemService()
            ->getItemsByEmployeeAndSiteId($employee, $id);

        return $this->render(
            'view',
            [
                'site' => $site,
                'workItems' => $workItems,
            ],
        );
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function actionCreate(): string|Response
    {
        $employee = App::user();

        if (!$employee->isAdmin()) {
            throw new ForbiddenHttpException();
        }

        $site = new ConstructionSite();

        if ($this->loadFromRequestAndSave($site)) {
            return $this->redirect(['view', 'id' => $site->id]);
        }

        return $this->render(
            'create',
            [
                'site' => $site,
            ],
        );
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function actionDelete(int $id): Response
    {
        $employee = App::user();

        if (!$employee->isAdmin()) {
            throw new ForbiddenHttpException();
        }

        $site = ConstructionSite::findOne($id);

        if (!$site->delete()) {
            throw new Exception("Ooops");
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function actionUpdate(int $id): string|Response
    {
        $employee = App::user();

        if (!$employee->isAdmin()) {
            throw new ForbiddenHttpException();
        }

        $site = ConstructionSite::findOne($id);

        if ($this->loadFromRequestAndSave($site)) {
            return $this->redirect(['view', 'id' => $site->id]);
        }

        return $this->render(
            'update',
            [
                'site' => $site,
            ],
        );
    }

    /**
     * Handle POST data.
     */
    private function loadFromRequestAndSave(ConstructionSite $site): bool
    {
        return $site->load(Yii::$app->request->post()) && $site->save();
    }
}