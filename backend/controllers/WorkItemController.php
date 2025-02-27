<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\Employee;
use common\repositories\WorkItemRepository;
use common\services\WorkItemService;
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
        $workItem = new WorkItemService()->getItemByEmployee($id, $employee);

        if (!$workItem->delete()) {
            throw new Exception("Ooops");
        }

        // return $this->redirect(['index']);
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

        if ($workItem->load(Yii::$app->request->post()) && $workItem->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['workItem' => $workItem]);
    }
}