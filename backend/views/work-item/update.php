<?php

declare(strict_types=1);

use common\models\ConstructionSite;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $workItem app\models\WorkItem */

$this->title = 'Update Work Item: ' . $workItem->name;
$this->params['breadcrumbs'][] = ['label' => 'Work Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $workItem->name, 'url' => ['view', 'id' => $workItem->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="work-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($workItem, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($workItem, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($workItem, 'construction_site_id')->dropDownList(
        ArrayHelper::map(ConstructionSite::find()->all(), 'id', 'name'),
        ['prompt' => 'Select Construction Site']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>