<?php
use yii\widgets\LinkPager;
use common\models\Cities;
use common\models\Countries;
?>
<section class="company-page with-rating">
<div class="content-wrapper">
    <h1><?php echo $model->name ?><div><span class="rating-grade green">5.00</span><a href="#">рейтинг фирмы</a></div></h1>
    <?php echo \frontend\modules\tourfirms\widgets\TourfirmReviewsWidget::widget(['id'=>$model->id, 'slug'=>$model->slug]) ?><ul class="tabs-container">
    <li><a href="/tourfirm/<?php echo $model->slug ?>">описание</a></li>
    <li ><a href="/tourfirm/<?php echo $model->slug ?>/reviews">отзывы</a></li>
    <li><a href="/tourfirm/<?php echo $model->slug ?>/contact">контакты</a></li>
    <li><a href="/tourfirm/<?php echo $model->slug ?>/article">новости/акции</a></li>
    <li><a href="/tourfirm/<?php echo $model->slug ?>/managers">менеджеры</a></li>
    <li class="active"><a href="/tourfirm/<?php echo $model->slug ?>/tours">туры <?php echo "(".count($model->tours).")" ?></a></li>
</ul>
    <p class="sort">Сортировать по:<?php echo $sort->link('created_at')?><?php echo $sort->link('count_nights')?><?php echo $sort->link('price')?></p>

<ul class="tours-list">
    <?php foreach($dataProvider->getModels() as $item){ ?>
    <li>
        <div clas   s="tour-name">
            <a href="/tour/<?php echo $item->slug ?>" class="blue"><?php echo $item->title ?></a>
            <div class="tour-rate">
                <div class="green rating-grade">5.00</div>
                <a href="">рейтинг фирмы</a>
            </div>
            <p>добавлен <?php echo convertDate($item->published_at)?></p>
        </div>
        <div class="tour-destination">
            <a href="/tourfirm/<?php echo $model->slug ?>/tours?TourSearch[country_id]=<?php echo $item->country_to_id ?>" class="blue"><?php echo Countries::getCountry($item->country_to_id) ?></a>
            <a href="/tourfirm/<?php echo $model->slug ?>/tours?TourSearch[city_id]=<?php echo $item->city_to_id ?>"><?php echo Cities::getCity($item->city_to_id) ?></a>
        </div>
        <div class="tour-duration">
            <p><?php echo $item->count_nights ?> ночей</p>
            <p><?php echo $item->count_days ?> дней</p>
        </div>
        <div class="tour-transport">
            <i class="fa fa-<?php echo $item->transport->class ?>"></i>
            <p><?php echo Cities::getCity($item->city_from_id) ?></p>
            <p><?php echo $item->date_from ?></p>
        </div>
        <div class="tour-capacity">
            <?php if(empty($item->count_kids)){ ?>
                <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class=""></i></p>
                <p>взрослыe - <?php echo $item->count_old ?> </p>
            <?php }else{ ?>
                <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-child"></i></p>
                <p>взрослыe - <?php echo $item->count_old ?><span> дети - <?php echo $item->count_kids ?></span></p>
            <?php }?>

        </div>
        <div class="tour-price">
            <?php if($item->hot){ ?>
                <div class="tour-hot visible">горящий тур</div>
            <?php } ?>
            <p><?php echo $item->price ?><span>rub.</span></p>
            <?php if(!user()->id){ ?>
                <div>
                    <a href="/site/notuser" class="ajax-link"><div class="tour-compare plus"></div></a>
                    <div class="tour-like"><a href="/site/notuser" class="ajax-link"><div class="heart"></div></a><span></span></div>
                </div>
            <?php }else{ ?>
                <?php if(\frontend\modules\tours\Module::getFavorits($item->id)){ ?>
                    <div>
                        <a href="/tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="tour-compare minus"></div></a>
                        <div class="tour-like"><a href="/tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                    </div>
                <?php }else{ ?>
                    <div>
                        <a href="/tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="tour-compare plus"></div></a>
                        <div class="tour-like"><a href="/tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                    </div>
                 <?php } ?>
            <?php } ?>
            <!-- <span class="tour-comparison-popup">
                 <span>2 тура в сравнении</span>
                 <div><a href="#"><i class="fa fa-trash"></i></a></div>
             </span>-->
        </div>
    </li>
    <?php } ?>
</ul>
    <?php echo LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
    ?>
</div>
</section>
