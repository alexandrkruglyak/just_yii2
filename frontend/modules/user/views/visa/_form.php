<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Tourfirms;
use common\models\User;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model common\models\Visa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(userModel()->isUserTourOperator()) { ?>
        <?php echo $form->field($model, 'manager_id')->dropDownList(User::getManagersOfCompany(), ['prompt' => 'Менеджер'])->label(false) ?>
    <?php }else{ ?>
        <?= $form->field($model, 'manager_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
    <?php }?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'country_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\frontend\controllers\SiteController::getCountries(),'country_id','name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ]);
    ?>

    <?php echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
        'type' => 2,
        'options' => ['id'=>'subcat-id-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id-id'],
            'placeholder' => 'Город',
            'url' => Url::to(['/site/cities'])
        ]
    ]);
    ?>


    <?= $form->field($model, 'tour_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'date_create')->hiddenInput(['value'=>234234])->label(false)  ?>

    <?= $form->field($model, 'date_update')->hiddenInput(['value'=>234234])->label(false)  ?>


    <?= $form->field($model, 'documents')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_time')->textInput() ?>
    <?= $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'registration_period')->textInput() ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>Tourfirms::getTourfirmId(user()->id)])->label(false)  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
