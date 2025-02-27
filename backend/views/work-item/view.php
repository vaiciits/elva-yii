<?php

declare(strict_types=1);

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $workItem app\models\WorkItem */

$this->title = $workItem->name;
$this->params['breadcrumbs'][] = ['label' => 'Work Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="work-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped">
        <tr>
            <th><?= Html::encode($workItem->getAttributeLabel('name')) ?></th>
            <td><?= Html::encode($workItem->name) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($workItem->getAttributeLabel('description')) ?></th>
            <td><?= Html::encode($workItem->description) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($workItem->getAttributeLabel('construction_site_id')) ?></th>
            <td><?= Html::encode($workItem->constructionSite->name) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($workItem->getAttributeLabel('employee_id')) ?></th>
            <td><?= Html::encode($workItem->employee->fullName) ?></td>
        </tr>
    </table>

</div>