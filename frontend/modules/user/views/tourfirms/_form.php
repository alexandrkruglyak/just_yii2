<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;

/* @var $this yii\web\View */
/* @var $model common\models\Tourfirms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tourfirms-form">
    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelPhons, 'default')->textInput() ?>
    <?= $form->field($modelPhons, 'mts')->textInput() ?>
    <?= $form->field($modelPhons, 'life')->textInput() ?>
    <?= $form->field($modelPhons, 'viber')->textInput() ?>
    <?= $form->field($modelPhons, 'skype')->textInput() ?>
    <?= $form->field($modelPhons, 'icq')->textInput() ?>

    <?= $form->field($model, 'legal_info')->textInput() ?>

    <?php echo $form->field($model, 'attachments')->widget(
        Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'sortable' => true,
            'maxFileSize' => 10000000, // 10 MiB
            'maxNumberOfFiles' => 10
        ]);
    ?>

    <?= $form->field($modelWorkTime, 'monday')->textInput()?>
    <?= $form->field($modelWorkTime, 'tuesday')->textInput()?>
    <?= $form->field($modelWorkTime, 'wednesday')->textInput()?>
    <?= $form->field($modelWorkTime, 'thursday')->textInput()?>
    <?= $form->field($modelWorkTime, 'friday')->textInput()?>
    <?= $form->field($modelWorkTime, 'saturday')->textInput()?>
    <?= $form->field($modelWorkTime, 'sunday')->textInput()?>

    <?= $form->field($model, 'touroperator_id')->hiddenInput(['value' => user()->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
