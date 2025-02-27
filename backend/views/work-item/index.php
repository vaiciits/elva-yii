<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use common\models\Employee;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Work items';

echo Html::tag('h1', Html::encode($this->title));

$employee = Yii::$app->user->identity;
if (in_array($employee->role, [Employee::ROLE_ADMIN, Employee::ROLE_MANAGER])) {
    echo Html::beginTag('p');
    echo Html::a('Create Work Item', ['create'], ['class' => 'btn btn-success']);
    echo Html::endTag('p');
}

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'description',
        [
            'attribute' => 'construction_site_id',
            'label' => 'Construction Site',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->constructionSite
                    ? Html::a($model->constructionSite->name, ['construction-site/view', 'id' => $model->construction_site_id])
                    : 'Not Assigned';
            },
        ],
        [
            'attribute' => 'employee_id',
            'label' => 'Employee',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->employee
                    ? Html::a($model->employee->getFullName(), ['employee/view', 'id' => $model->employee_id])
                    : 'Not Assigned';
            },
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return ["work-item/{$model->id}/$action"];
            },
            'visibleButtons' => [
                'update' => function ($model) use ($employee) {
                    return $employee->role === Employee::ROLE_ADMIN;
                },
                'delete' => function ($model) use ($employee) {
                    return $employee->role === Employee::ROLE_ADMIN;
                },
            ],
        ],
    ],
]);