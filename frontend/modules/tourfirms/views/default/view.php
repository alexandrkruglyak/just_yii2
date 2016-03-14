<section class="company-page with-rating">
    <div class="content-wrapper">
        <h1><?php echo $model->name ?><div><span class="rating-grade green">5.00</span><a href="#">рейтинг фирмы</a></div></h1>
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmReviewsWidget::widget(['id'=>$model->id, 'slug'=>$model->slug]) ?>        <ul class="tabs-container">
            <li class="active"><a href="#">описание</a></li>
            <li><a href="<?php echo $model->slug ?>/reviews">отзывы</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/contact">контакты</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/article">новости/акции</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/managers">менеджеры</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/tours">туры (<?php echo count($model->tours) ?>)</a></li>
        </ul>
        <div class="company-desc">
            <div class="desc-head">
                <div class="company-logo-group">
                    <div>
                        <div>
                            <img src="img/company-logo.jpg" alt="Company">
                        </div>
                        <div class="timing">
                            <h3><i class="fa fa-clock-o"></i>Время работы</h3>
                            <ul>
                                <li>понедельник: <?php echo $model->tourfirmWorkTime->monday ?></li>
                                <li>вторник: <?php echo $model->tourfirmWorkTime->tuesday ?></li>
                                <li>среда: <?php echo $model->tourfirmWorkTime->wednesday ?></li>
                                <li>четверг: <?php echo $model->tourfirmWorkTime->thursday ?></li>
                                <li>пятница: <?php echo $model->tourfirmWorkTime->friday ?></li>
                                <li>суббота: <?php echo $model->tourfirmWorkTime->saturday ?></li>
                                <li>воскресенье: <?php echo $model->tourfirmWorkTime->sunday ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <h3><i class="fa fa-folder"></i>Юридическая информация</h3>
                    <p><?php echo $model->legal_info ?></p>
                </div>
                <div class="contact">
                    <h3><i class="fa fa-map-marker"></i>Контакты</h3>
                    <a href="#"><?php echo $model->address ?></a>
                    <ul>
                        <?php if($model->tourfirmsPhon->default){?><li class="contact-phone"><?php echo $model->tourfirmsPhon->default ?></li><?php } ?>
                        <?php if($model->tourfirmsPhon->life){?><li class="contact-life"><?php echo $model->tourfirmsPhon->life ?></li><?php } ?>
                        <?php if($model->tourfirmsPhon->mts){?><li class="contact-mts"><?php echo $model->tourfirmsPhon->mts ?></li><?php } ?>
                        <?php if($model->tourfirmsPhon->viber){?><li class="contact-viber"><?php echo $model->tourfirmsPhon->viber ?></li><?php } ?>
                        <?php if($model->tourfirmsPhon->skype){?><li class="contact-skype"><?php echo $model->tourfirmsPhon->skype ?></li><?php } ?>
                        <?php if($model->tourfirmsPhon->icq){?><li class="contact-icq"><?php echo $model->tourfirmsPhon->icq ?></li><?php } ?>
                    </ul>
                </div>
            </div>
            <div class="company-desc-text">
                <h5><?php echo $model->name ?></h5>
                <p><?php echo $model->description ?></p>
            </div>
            <div class="company-desc-grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 252, "gutter": 30 }'>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
                <div class="grid-item"><img src="" alt="" style="background:black"></div>
            </div>
        </div>
    </div>
</section>
