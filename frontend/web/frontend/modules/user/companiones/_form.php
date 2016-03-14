<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companiones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'age_with')->textInput() ?>

    <?= $form->field($model, 'age_to')->textInput() ?>

    <?= $form->field($model, 'type_travel_id')->textInput() ?>

    <?= $form->field($model, 'purpose_travel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_me')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_traveler')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travel_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender_traveler')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
