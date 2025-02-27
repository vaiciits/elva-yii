<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Employee $employee */

$this->title = 'Update Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="work-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($employee, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($employee, 'surname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($employee, 'birthdate')->textInput(['maxlength' => true]) ?>
    <?= $form->field($employee, 'access')->dropDownList(
        [
            1 => 1,
            2 => 2,
            3 => 3,
        ],
        ['prompt' => 'Select Access Level'],
    ) ?>
    <?= $form->field($employee, 'role')->dropDownList(
        [
            1 => 'Admin',
            2 => 'Manager',
            3 => 'Employee',
        ],
        ['prompt' => 'Select Role'],
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>