<?php

declare(strict_types=1);

use backend\enums\Role;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Employee $employee */

$this->title = $employee->name;
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped">
        <tr>
            <th><?= Html::encode($employee->getAttributeLabel('name')) ?></th>
            <td><?= Html::encode($employee->name) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($employee->getAttributeLabel('surname')) ?></th>
            <td><?= Html::encode($employee->surname) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($employee->getAttributeLabel('birthdate')) ?></th>
            <td><?= Html::encode($employee->birthdate) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($employee->getAttributeLabel('access')) ?></th>
            <td><?= Html::encode($employee->access) ?></td>
        </tr>
        <tr>
            <th><?= Html::encode($employee->getAttributeLabel('role')) ?></th>
            <td><?= Html::encode(Role::uppercaseFirst($employee->role)) ?></td>
        </tr>
    </table>
</div>