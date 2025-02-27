<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Work items';

echo Html::tag('h1', Html::encode($this->title));

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'description',
        'construction_site_id',
        'employee_id',
        ['class' => 'yii\grid\ActionColumn'],  // Edit/View/Delete buttons
    ],
]);