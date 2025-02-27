<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\Employee;
use common\models\WorkItem;
use common\repositories\WorkItemRepository;
use common\services\ConstructionSiteService;
use common\services\EmployeeService;
use common\services\WorkItemService;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class WorkItemController extends Controller
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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

    public function actionView(int $id): string
    {
        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();
        $workItem = new WorkItemService()->getItemByEmployee(
            $id,
            $employee,
            [
                Employee::ROLE_ADMIN,
                Employee::ROLE_MANAGER,
                Employee::ROLE_EMPLOYEE,
            ],
        );

        return $this->render('view', [
            'workItem' => $workItem,
        ]);
    }

    /**
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionDelete(int $id): Response
    {
        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();
        $workItem = new WorkItemService()->getItemByEmployee($id, $employee);

        if (!$workItem->delete()) {
            throw new Exception("Ooops");
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id): string|Response
    {
        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();
        $workItem = new WorkItemService()->getItemByEmployee($id, $employee);

        if ($this->loadFromRequestAndSave($workItem)) {
            return $this->redirect(['view', 'id' => $workItem->id]);
        }

        return $this->render('update', [
            'workItem' => $workItem,
        ]);
    }

    public function actionCreate(): string|Response
    {
        $workItem = new WorkItem();

        if ($this->loadFromRequestAndSave($workItem)) {
            return $this->redirect(['view', 'id' => $workItem->id]);
        }

        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();

        return $this->render('create', [
            'workItem' => $workItem,
            'availableSites' => new ConstructionSiteService()
                ->getAvailableSitesByEmployee($employee),
            'allowedEmployees' => new EmployeeService()
                ->getAvailableEmployees($employee),
        ]);
    }

    /**
     * Handle POST data.
     */
    private function loadFromRequestAndSave(WorkItem $workItem): bool
    {
        return $workItem->load(Yii::$app->request->post()) && $workItem->save();
    }
}