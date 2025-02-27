<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Construction sites';

echo Html::tag('h1', Html::encode($this->title));

echo Html::beginTag('p');
echo Html::a('Create Construction site', ['create'], ['class' => 'btn btn-success']);
echo Html::endTag('p');

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'location',
        'area',
        'access',
        [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return ["construction-site/{$model->id}/$action"];
            },
        ],
    ],
]);