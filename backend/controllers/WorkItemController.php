<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\Employee;
use common\models\WorkItem;
use common\repositories\WorkItemRepository;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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

    /**
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionDelete(int $id): Response
    {
        /** @var Employee */
        $employee = Yii::$app->user->getIdentity();
        if ($employee->role !== Employee::ROLE_ADMIN) {
            throw new ForbiddenHttpException("Not allowed.");
        }

        $workItem = WorkItem::findOne($id);
        if (!$workItem) {
            throw new NotFoundHttpException("This work item does not exist");
        }

        if (!$workItem->delete()) {
            throw new Exception("Ooops");
        }

        return $this->redirect(['index']);
    }
}