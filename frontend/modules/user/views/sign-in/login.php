<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form password_rec_sendSMS']); ?>
    <?php echo $form->field($model, 'identity') ?>
    <?php echo $form->field($model, 'password')->passwordInput() ?>
    <div class="under-form">
        <a class="forgot_pw" href="#">Забыли пароль?</a>
        <?php echo l('Забыли пароль?', url('sign-in/request-password-reset'),['class'=>'forgot_pw']);?>
        <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
    <input type="submit" value="ВОЙТИ">
<?php ActiveForm::end(); ?>


