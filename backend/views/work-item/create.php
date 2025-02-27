<?php

declare(strict_types=1);

use common\models\ConstructionSite;
use common\models\Employee;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $workItem app\models\WorkItem */

$this->title = 'Create Work Item';
$this->params['breadcrumbs'][] = ['label' => 'Work Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create';
?>

<div class="work-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($workItem, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($workItem, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($workItem, 'construction_site_id')->dropDownList(
        ArrayHelper::map(ConstructionSite::find()->all(), 'id', 'name'),
        ['prompt' => 'Select Construction Site']
    ) ?>

    <?= $form->field($workItem, 'employee_id')->dropDownList(
        ArrayHelper::map(Employee::find()->all(), 'id', 'fullName'),
        ['prompt' => 'Select Employee']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>