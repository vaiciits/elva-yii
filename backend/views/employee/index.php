<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use backend\enums\Role;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Employees';

echo Html::tag('h1', Html::encode($this->title));

echo Html::beginTag('p');
echo Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']);
echo Html::endTag('p');

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'surname',
        'bithdate',
        'access',
        [
            'attribute' => 'role',
            'label' => 'Role',
            'value' => function ($model) {
                return ucfirst(strtolower(Role::tryFrom($model->role)->name));
            },
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return ["construction-site/{$model->id}/$action"];
            },
        ],
    ],
]);