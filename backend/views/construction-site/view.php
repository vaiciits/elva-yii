<?php

declare(strict_types=1);

use common\models\ConstructionSite;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ConstructionSite $site */
/** @var WorkItem[] $workItems */

$this->title = $site->name;
$this->params['breadcrumbs'][] = ['label' => 'Construction site', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="construction-site-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped">
        <tr>
            <th><?= Html::encode($site->getAttributeLabel('name')) ?></th>
            <td><?= Html::encode($site->name) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($site->getAttributeLabel('location')) ?></th>
            <td><?= Html::encode($site->location) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($site->getAttributeLabel('area')) ?></th>
            <td><?= Html::encode($site->area) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($site->getAttributeLabel('access')) ?></th>
            <td><?= Html::encode($site->access) ?></td>
        </tr>
    </table>

    <h2><?= Html::encode('Work items') ?></h2>

    <?php

    echo GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => $workItems,
            'pagination' => false,
        ]),
        'columns' => [
            'id',
            'name',
            'description',
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
        ],
    ]);
    ?>
</div>