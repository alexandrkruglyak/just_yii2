<section class="company-page with-rating">
<div class="content-wrapper">
    <h1><?php echo $model->name ?><div><span class="rating-grade green">5.00</span><a href="#">рейтинг фирмы</a></div></h1>
    <?php echo \frontend\modules\tourfirms\widgets\TourfirmReviewsWidget::widget(['id'=>$model->id, 'slug'=>$model->slug]) ?>    <ul class="tabs-container">
        <li><a href="/tourfirm/<?php echo $model->slug ?>">описание</a></li>
        <li><a href="/tourfirm/<?php echo $model->slug ?>/reviews">отзывы</a></li>
        <li><a href="/tourfirm/<?php echo $model->slug ?>/contact">контакты</a></li>
        <li><a href="/tourfirm/<?php echo $model->slug ?>/article">новости/акции</a></li>
        <li class="active"><a href="#">менеджеры</a></li>
        <li><a href="/tourfirm/<?php echo $model->slug ?>/tours">туры (<?php echo count($model->tours) ?>)</a></li>
    </ul>
    <div class="company-managers">
        <?php foreach($model->managers as $manager){ ?>
        <div class="manager">
            <div>
                <i class="fa fa-commenting-o"></i>
                <img src="img/company-manager.jpg" alt="">
            </div>
            <ul class="manager-contact">
            <?php $modelManagerPhone = \common\models\ManagersPhone::find()->where(['manager_id'=>$manager->profile_manager_id])->all()?>
                <?php foreach($modelManagerPhone as $phone){ ?>
                    <?php if($phone->default){ ?><li class="contact-phone"><?php echo $phone->default ?></li><?php }?>
                    <?php if($phone->life){?><li class="contact-life"><?php echo $phone->life ?></li><?php }?>
                    <?php if($phone->mts){?><li class="contact-mts"><?php echo $phone->mts ?></li><?php }?>
                    <?php if($phone->viber){?><li class="contact-viber"><?php echo $phone->viber ?></li><?php }?>
                    <?php if($phone->skype){?><li class="contact-skype"><?php echo $phone->skype ?></li><?php }?>
                    <?php if($phone->icq){?><li class="contact-icq"><?php echo $phone->icq ?></li><?php }?>
                <?php } ?>
            </ul>
            <p><?php echo \common\models\User::getName($manager->profile_manager_id) ?></p>
        </div>
        <?php } ?>
    </div>
</div>
    </section>