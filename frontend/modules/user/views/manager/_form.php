<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\user\models\SignupForm;
use common\models\UserProfile;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput()?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelManagerPhone, 'default')->textInput() ?>
    <?= $form->field($modelManagerPhone, 'life')->textInput() ?>
    <?= $form->field($modelManagerPhone, 'mts')->textInput() ?>
    <?= $form->field($modelManagerPhone, 'viber')->textInput() ?>
    <?= $form->field($modelManagerPhone, 'skype')->textInput() ?>
    <?= $form->field($modelManagerPhone, 'icq')->textInput() ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false); ?>
    <?= $form->field($model, 'type')->hiddenInput(['value'=>3])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
