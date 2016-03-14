<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<section class="company-page with-rating">
    <div class="content-wrapper">
        <h1><?php echo $model->name ?><div><span class="rating-grade green">5.00</span><a href="#">рейтинг фирмы</a></div></h1>
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmReviewsWidget::widget(['id'=>$model->id, 'slug'=>$model->slug]) ?>
        <ul class="tabs-container">
            <li><a href="/tourfirm/<?php echo $model->slug ?>">описание</a></li>
            <li ><a href="/tourfirm/<?php echo $model->slug ?>/reviews">отзывы</a></li>
            <li class="active"><a href="#">контакты</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/article">новости/акции</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/managers">менеджеры</a></li>
            <li ><a href="/tourfirm/<?php echo $model->slug ?>/tours">туры <?php echo "(".count($model->tours).")" ?></a></li>
        </ul>
        <div class="contacts-container">
            <h1>Телефоны</h1>
            <ul class="manager-contact">
                <?php if( $model->tourfirmsPhon->default){?><li class="contact-phone"><?php echo $model->tourfirmsPhon->default ?></li><?php } ?>
                <?php if( $model->tourfirmsPhon->life){?><li class="contact-life"><?php echo $model->tourfirmsPhon->life ?></li><?php } ?>
                <?php if( $model->tourfirmsPhon->mts){?><li class="contact-mts"><?php echo $model->tourfirmsPhon->mts ?></li><?php } ?>
                <?php if( $model->tourfirmsPhon->viber){?><li class="contact-viber"><?php echo $model->tourfirmsPhon->viber ?></li><?php } ?>
                <?php if( $model->tourfirmsPhon->skype){?><li class="contact-skype"><?php echo $model->tourfirmsPhon->skype ?></li><?php } ?>
                <?php if( $model->tourfirmsPhon->icq){?><li class="contact-icq"><?php echo $model->tourfirmsPhon->icq ?></li><?php } ?>
            </ul>
            <h1>Обратная связь</h1>
            <?php $form = ActiveForm::begin(
                [
                    'action'=>'/tourfirms/feedback',
                    'options' => [
                        'class' => 'feedback-form ajax-form'
                    ]
                ]);
            ?>
            <?php $mdoelFeed = new \common\models\CustomerFeedback(); ?>
            <?= $form->field($mdoelFeed, 'name')->textInput(['value'=>'', 'placeholder'=>"Ваше имя"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'email')->textInput(['value'=>'', 'placeholder'=>"Ваш email"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'phone')->textInput(['value'=>'', 'placeholder'=>"Ваш телефон"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'question')->textarea(['rows' => 6, 'value'=>'', 'placeholder'=>"Ваш вопрос"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'tourfirm_id')->hiddenInput(['value' => $model->id])->label(false) ?>
            <?= $form->field($mdoelFeed, 'user_id')->hiddenInput(['value' => user()->id])->label(false) ?>
            <?= $form->field($mdoelFeed, 'date_create')->hiddenInput(['value' => time()])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' =>'batton yellow']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <h1>Адрес</h1>
            <div class="contact-map">
                <p>
                    <i class="fa fa-map-marker"></i>
                    <a href="#"><?php echo $model->address ?></a>
                </p>
                <div class="map-canvas"></div>
            </div>
        </div>
    </div>
</section>