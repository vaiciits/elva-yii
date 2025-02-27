<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use common\models\Employee;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to login:</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'employee_id')->dropDownList(
            Employee::find()->select(["(name + ' ' + surname) AS full_name", 'id'])->indexBy('id')->column(),
            ['prompt' => 'Select employee'],
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>