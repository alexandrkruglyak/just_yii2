<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\base\MultiModel */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="register-page">
    <div class="content-wrapper">
        <h1>Регистрация</h1>
        <?php $form = ActiveForm::begin(['id' => 'register', 'options' => [
            'class' => 'user-form',
        ]]); ?>
        <div class="button-line">
            <input type="radio" checked="checked" name="SignupForm[type]" value="1" id="tourist"/>
            <label for="tourist">Турист</label>
            <input type="radio" name="SignupForm[type]" value="2" id="tourfirm"/>
            <label for="tourfirm">Турфирма</label>
        </div>
        <div class="container">

            <?php echo $form->field($model->getModel('signup'), 'username')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Логин'])->label(false) ?>

            <?php echo $form->field($model->getModel('signup'), 'password')->passwordInput(['class' => 'user-form firm-form', 'placeholder' => 'Пароль'])->label(false) ?>

            <?php echo $form->field($model->getModel('signup'), 'email')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>


            <?php echo $form->field($model->getModel('profile'), 'firstname')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Ваш имя'])->label(false) ?>

            <?php echo $form->field($model->getModel('profile'), 'lastname')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Ваш фамилия'])->label(false) ?>

            <?php echo $form->field($model->getModel('profile'), 'gender')->dropDownList(['1'=>'Мужской','2'=>'Женский'],['class' => 'select user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

            <?php echo $form->field($model->getModel('profile'), 'byear')->dropDownList(range(1990,2016),['class' => 'select user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

            <?php echo $form->field($model->getModel('profile'), 'bmonth')->dropDownList(range(1,12),['class' => 'select user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

            <?php echo $form->field($model->getModel('profile'), 'bday')->dropDownList([range(1,31)],['class' => 'select user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

            <?php echo $form->field($model->getModel('profile'), 'country')->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\frontend\controllers\SiteController::getCountries(),'country_id','name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label(false);
            ?>
            <?php echo $form->field($model->getModel('profile'), 'city')->widget(DepDrop::classname(), [
                'type' => 2,
                'options' => ['id'=>'subcat-id'],
                'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder' => 'Select...',
                    'url' => Url::to(['/site/cities'])
                ]
            ])->label(false);
                ?>

        </div>
        <input type="checkbox" id="terms">
        <label for="terms">Я принимаю <a href="#">условия пользовательского соглашения</a> и ознакомлен с <a href="#">политикой
                конфиденциальности</a>.</label>
        <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>

