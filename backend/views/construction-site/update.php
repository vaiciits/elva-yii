<?php

declare(strict_types=1);

use common\models\ConstructionSite;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var ConstructionSite $site */

$this->title = 'Update Construction site';
$this->params['breadcrumbs'][] = ['label' => 'Construction sites', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="work-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($site, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($site, 'location')->textInput(['maxlength' => true]) ?>
    <?= $form->field($site, 'area')->textInput() ?>
    <?= $form->field($site, 'access')->dropDownList(
        [
            1 => 1,
            2 => 2,
            3 => 3,
        ],
        ['prompt' => 'Select Access Level'],
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>