<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
            <?php $form = ActiveForm::begin(['id' => 'register', 'options' => [
                'class' => 'user-form',
            ]]); ?>
                <h2><?php echo Yii::t('frontend', 'Account Settings') ?></h2>

                <?php echo $form->field($model->getModel('account'), 'username')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Логин'])->label(false) ?>

                <?php echo $form->field($model->getModel('account'), 'email')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

                <?php echo $form->field($model->getModel('account'), 'password')->passwordInput(['class' => 'user-form firm-form', 'placeholder' => 'Пароль'])->label(false) ?>

                <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput(['class' => 'user-form firm-form', 'placeholder' => 'Повторите пароль'])->label(false) ?>

                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
