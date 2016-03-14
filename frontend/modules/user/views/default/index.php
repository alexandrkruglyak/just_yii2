<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
    use kartik\select2\Select2;
    use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('frontend', 'User Settings');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="head-symbol"><i class="fa fa-commenting"></i></div>
<h1><?php echo Yii::t('frontend', 'Profile settings') ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'register', 'options' => [
                'class' => 'user-form make-order-form',
            ]]); ?>
<div class="main-info">
                <?php echo $form->field($model, 'picture')->widget(
                    Upload::classname(),
                    [
                        'url' => ['avatar-upload']
                    ]
                ) ?>
                <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваше имя'])->label(false) ?>

                <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваша фамилия'])->label(false) ?>

                <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваше отчество'])->label(false) ?>
                <?php echo $form->field($model, 'byear')->dropDownList(range(1990,2016),['class' => 'select user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

                <?php echo $form->field($model, 'bmonth')->dropDownList(range(1,12),['class' => 'select user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

                <?php echo $form->field($model, 'bday')->dropDownList([range(1,31)],['class' => 'select user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

                <?php echo $form->field($model, 'country')->widget(Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map($countries,'country_id','name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])->label(false);
                ?>

                <?php echo $form->field($model, 'city')->widget(Select2::classname(), [
                    'data'=>\yii\helpers\ArrayHelper::map(['$model->citySelect'],'id','city'),
                    'options' => ['disabled' => true]
                ])->label(false);
                ?>
                <?php echo $form->field($model, 'gender')->dropDownlist([
                    \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Мужской'),
                    \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Женский')
                ], ['prompt' => 'Ваш пол'])->label(false) ?>


                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
                </div>
</div>
            <?php ActiveForm::end(); ?>
