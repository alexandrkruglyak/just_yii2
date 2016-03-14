<?php
use common\models\Countries;
use common\models\Cities;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper">
    <div class="wrapper-inner">
        <div class="head-symbol"><i class="fa fa-smile-o"></i></div>
        <h1>Создайте заявку</h1>
        <?php $form = ActiveForm::begin(); ?>
            <div class="container textareas">
                <?= $form->field($model, 'travel_location')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'Куда вы планируете поехать?'])->label(false) ?>
                <?= $form->field($model, 'purpose_travel')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'Цель поездки'])->label(false) ?>
                <?= $form->field($model, 'about_me')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'О себе'])->label(false)  ?>
                <?= $form->field($model, 'about_traveler')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'О попутчике'])->label(false) ?>
                <?= $form->field($model, 'age_with')->textInput(['placeholder'=>'Возраст попутчика c'])->label(false) ?>
                <?= $form->field($model, 'age_to')->textInput(['placeholder'=>'Возраст попутчика до'])->label(false) ?>
                <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
            </div>
            <div class="container nutrition-prefs">
                <?php
                    $modGenders = \common\models\CompanionesGender::find()->all();
                    $arr = [];
                    foreach($modGenders as $item){
                        $arr[$item->id] = $item->gender;
                    }
                ?>
                <?= $form->field($model, 'gender_traveler')->radioList($arr) ?>
            </div>
            <p class="section">ИНТЕРЕСЫ:</p>
             <div class="hotel-prefs">
                <?= $form->field($model, 'interes')->textInput(['placeholder'=>'Ваши интересы в путешествии...'])->label(false) ?>
                <a href="#">ДОБАВИТЬ</a>
                <div class="sep"></div>
                <div class="selected-hotel">
                     Любой
                     <i class="fa fa-close"></i>
                 </div>
            </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать заявку' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <h2>Мои заявки</h2>
    <div class="companions-container">
        <?php foreach($myCompaniones as $item){ ?>
            <article>
            <div class="main-info">
                <div class="creds">
                    <a href="#">
                        <img src="img/user-1.jpg" alt="">
                        <i class="fa fa-comment"></i>
                    </a>
                    <div>
                        <p class="name"><span><?php echo $item->myCompaniones->firstname?>  <?php echo $item->myCompaniones->lastname?></span><span class="age violet"><?php echo $item->myCompaniones->byear?>лет</span><span class="location"><?php echo Countries::getCountry($item->myCompaniones->country)?>, <?php echo Cities::getCity($item->myCompaniones->country)?></span></p>
                        <div><i class="fa fa-transgender"></i>Ищу в попутчики компанию</div>
                        <div><i class="fa fa-user"></i>Возраст <?php echo $item->age_with?></div>
                    </div>
                </div>
                <div class="target">
                    <p class="destination"><?php echo $item->travel_location?></p>
                    <p><span>Цель поездки:</span><?php echo $item->purpose_travel?></p>
                    <p><span>О себе:</span> <?php echo $item->about_me?></p>
                    <p><span>О попутчике:</span> <?php echo $item->about_traveler?></p>
                </div>
            </div>
            <a href="#" class="tag">лыжи</a>
            <a href="#" class="tag">сноуборд</a>
        </article>
        <?php } ?>
    </div>
</div>