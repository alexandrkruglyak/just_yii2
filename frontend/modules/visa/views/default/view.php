<<?php
    use yii\widgets\ActiveForm;
    use yii\bootstrap\Html;
?>
<section class="visa-full-page">
    <div class="content-wrapper">
        <h1><?php echo \common\models\Countries::getCountry($model->country_id) ?></h1>
        <p><?php echo \common\models\Cities::getCity($model->city_id) ?></p>
        <hr>
        <div class="visa-head">
            <div class="visa-name">
                <a href="" class="blue"><?php echo $model->name ?></a>
                <div class="tour-rate">
                    <div class="green rating-grade">5.00</div>
                    <a href="">рейтинг фирмы</a>
                </div>
                <p>добавлена <?php echo convertDate($model->date_create) ?></p>
            </div>
            <div class="visa-type">
                <p><?php echo $model->type ?></p>
                <p><?php echo $model->type_time ?></p>
            </div>
            <div class="tour-price">
                <p><?php echo $model->price ?> <span>руб.</span></p>
                <?php if(!user()->id){ ?>
                    <div>
                        <a href="/site/notuser" class="login"><div class="tour-compare plus"></div></a>
                        <div class="tour-like"><a href="/site/notuser" class="login"><div class="heart"></div></a><span></span></div>
                    </div>
                <?php }else{ ?>
                    <?php if(\frontend\modules\visa\Module::getFavorits($model->id)){ ?>
                        <div>
                            <a href="/visa/favorits?save=0&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="tour-compare minus"></div></a>
                            <div class="tour-like"><a href="/visa/favorits?save=0&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                        </div>
                    <?php }else{ ?>
                        <div>
                            <a href="/visa/favorits?save=1&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="tour-compare plus"></div></a>
                            <div class="tour-like"><a href="/visa/favorits?save=1&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="visa-desc">
            <p class="req-time"><i class="fa fa-clock-o"></i>Срок оформления: <strong><?php echo $model->registration_period ?> дней</strong></p>
            <div>
                <p class="req-docs"><i class="fa fa-folder-o"></i>Документы:</p>
                <ul>
                    <li>- <?php echo $model->documents ?></li>

                </ul>
            </div>
        </div>
        <h1>Информация о визе</h1>
        <div class="company-desc-text">
            <p><?php echo $model->description ?></p>
        </div>
        <script type="text/javascript">
         (function() {
                  if (window.pluso)if (typeof window.pluso.start == "function") return;
                  if (window.ifpluso==undefined) { window.ifpluso = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                    var h=d[g]('body')[0];
                    h.appendChild(s);
                    }})();
        </script>
        <div class="pluso" data-background="#ebebeb" data-options="big,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>
        <div class="button-line">
            <a href="#" class="button yellow order-trigger">Заказать визу</a>
            <a href="#" class="button yellow info-trigger">Уточнить информацию</a>
        </div>
        <div class="manager">
            <h1>Менеджер визы</h1>
            <div class="manager-photo">
                <img src="img/manager-photo.jpg" alt="">
            </div>
            <h1><?php echo $model->manager->username ?></h1>
            <ul class="manager-contact">
                <?php if(isset($model->managerPhon->default)){?><li class="contact-phone"><?php echo $model->managerPhon->default ?></li><?php } ?>
                <?php if(isset($model->managerPhon->life)){?><li class="contact-life"><?php echo $model->managerPhon->life ?></li><?php } ?>
                <?php if(isset($model->managerPhon->mts)){?><li class="contact-mts"><?php echo $model->managerPhon->mts ?></li><?php } ?>
                <?php if(isset($model->managerPhon->viber)){?><li class="contact-viber"><?php echo $model->managerPhon->viber ?></li><?php } ?>
                <?php if(isset($model->managerPhon->skype)){?><li class="contact-skype"><?php echo $model->managerPhon->skype ?></li><?php } ?>
                <?php if(isset($model->managerPhon->icq)){?><li class="contact-icq"><?php echo $model->managerPhon->icq ?></li><?php } ?>
            </ul>
        </div>
        <div class="w_popup info_popup">
            <i class="fa fa-times popup_close"></i>
            <div class="popup_head">Уточнить информацию</div>
            <?php $form = ActiveForm::begin([
                'action'=>'/site/informations',
                'id'=>'leave-report-form',
                'options' => [
                    'class' => 'ajax-form'
                ]]);
            ?>
            <?php $modelInfo = new \common\models\UserIformation() ?>
            <?= $form->field($modelInfo, 'name')->textInput(['type'=>'text','placeholder'=>'Ваше имя'])->label(false) ?>
            <?= $form->field($modelInfo, 'email')->textInput(['type'=>'text','placeholder'=>'Ваш email'])->label(false) ?>
            <?= $form->field($modelInfo, 'question')->textarea(['cols'=>30, 'rows'=>10,'placeholder'=>'Ваш вопрос'])->label(false) ?>
            <?= $form->field($modelInfo, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
            <?= Html::submitButton('Отправить') ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="w_popup order_popup">
            <i class="fa fa-times popup_close"></i>
            <div class="popup_head">Заказать визу</div>
            <?php $form = ActiveForm::begin([
                'action'=>'/visa/order',
                'id'=>'order_visa',
                'options' => [
                    'class' => 'ajax-form'
                ]]);
            ?>
            <?php $modelVisa = new \common\models\VisaOrder(); ?>
            <?= $form->field($modelVisa, 'name')->textInput(['type'=>'text','placeholder'=>'Ваше имя'])->label(false) ?>
            <?= $form->field($modelVisa, 'email')->textInput(['type'=>'text','placeholder'=>'Ваш email'])->label(false) ?>
            <?= $form->field($modelVisa, 'visa_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
            <?= $form->field($modelVisa, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
            <?= Html::submitButton('Отправить') ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
