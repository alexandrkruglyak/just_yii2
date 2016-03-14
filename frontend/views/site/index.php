<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\Countries;
use common\models\Cities;
?>
<section>
    <div class="content-wrapper">
        <h1>Подбери тур своей мечты!</h1>
        <p>Поиск туров от всех турфирм Республики Беларусь</p>

        <form action="/tours" id="filter" method="GET">
            <label class="selects" >
                <select name="ToursSearch[country_to_id]">
                    <option value="" selected>Любая страна</option>
                </select>
            </label>
            <label class="selects">
                <select name="ToursSearch[city_to_id]">
                    <option value="" selected>Любой курорт</option>
                </select>
            </label>
            <label class="selects">
                <select name="ToursSearch[date_from]">
                    <option value="" selected>Дата</option>
                </select>
            </label>
            <label class="selects">
                <select name="ToursSearch[city_from_id]">
                    <option value="" selected>Из любого города</option>
                </select>
            </label>
            <label class="selects">
                <select>
                    <option value="" selected>Куда-нибудь</option>
                </select>
            </label>
            <div class="extended">
                <a href="">расширенный поиск</a>
            </div>
            <button class="button-hollow">ПОЕХАЛИ!</button>
        </form>
    </div>
</section>
<div class="sinusoid"></div>
<section>
    <div class="content-wrapper">
        <section class="tours">
            <h1>Новые туры</h1>
            <p>Недавно добавленные туры белорусских турфирм</p>
            <ul class="tours-list">
                <?php

//                dump((time() / 60) % 60);

                ?>
                <?php foreach($tours->query as $item){ ?>
                    <li class="">
                        <div class="tour-name">
                            <a href="/tour/<?php echo $item->slug ?>" class="blue"><?php echo $item->title ?></a>
                            <div class="tour-rate">
                                <div class="lime-orange rating-grade">3.80</div>
                                <a href="">рейтинг фирмы</a>
                            </div>
                            <p>добавлен <?php echo convertDate($item->published_at)?></p>
                        </div>
                        <div class="tour-destination">
                            <a href="/tours?ToursSearch[country_to_id]=<?php echo $item->country_to_id ?>" class="blue"><?php echo Countries::getCountry($item->country_to_id) ?></a>
                            <a href="/tours?ToursSearch[city_to_id]=<?php echo $item->city_to_id ?>"><?php echo Cities::getCity($item->city_to_id) ?></a>
                        </div>
                        <div class="tour-duration">
                            <p><?php echo $item->count_nights ?> ночей</p>
                            <p><?php echo $item->count_days ?>  дней</p>
                        </div>
                        <div class="tour-transport">
                            <i class="fa fa-<?php echo $item->transport->class ?>"></i>
                            <p><?php echo Cities::getCity($item->city_from_id) ?></p>
                            <p><?php echo $item->date_from ?></p>
                        </div>
                        <div class="tour-capacity">
                            <?php if(!$item->count_kids){ ?>
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
                                    <a href="#" class="login"><div class="tour-compare plus"></div></a>
                                    <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                                </div>
                            <?php }else{ ?>
                                <?php if(\frontend\modules\tours\Module::getFavorits($item->id)){ ?>
                                    <div>
                                        <a href="tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="tour-compare minus"></div></a>
                                        <div class="tour-like"><a href="tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                                    </div>
                                <?php }else{ ?>
                                    <div>
                                        <a href="tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="tour-compare plus"></div></a>
                                        <div class="tour-like"><a href="tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
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
            <a href="/tours?sort=-created_at" class="button-hollow">Больше туров</a>
        </section>
    </div>
</section>
<div class="sinusoid"></div>
<section class="news-block">
    <div class="content-wrapper">
        <h1>Новости портала</h1>
        <p>Новости туризма и наших турфирм</p>
        <div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 255, "gutter": 30 }'>
            <a href="<?php echo $big->getViewUrl(); ?>" class="grid-item grid-item--quad">
                <div class="container">
                    <span class="label-news">новости</span>
                    <span class="label-date"><?php echo $big->getDate(); ?></span>
                    <div class="mask"></div>
                </div>
                <span class="label-desc"><?php echo $big->getCF('title'); ?></span>
            </a>
        <?php echo \frontend\modules\article\widgets\shortview\SWidget::widget(); ?>
        </div>
        <a href="<?php echo \frontend\modules\article\Module::urlAll(); ?>" class="button yellow">Все новости</a>
        <section class="tours">
            <h1>Обрати внимание!</h1>
            <p>Туры, на которые стоит обратить внимание :)</p>
            <ul class="tours-list">
                <?php foreach($tours->query as $item){ ?>
                    <li class="">
                        <div class="tour-name">
                            <a href="/tour/<?php echo $item->slug ?>" class="blue"><?php echo $item->title ?></a>
                            <div class="tour-rate">
                                <div class="lime-orange rating-grade">3.80</div>
                                <a href="">рейтинг фирмы</a>
                            </div>
                            <p>добавлен <?php echo convertDate($item->published_at)?></p>
                        </div>
                        <div class="tour-destination">
                            <a href="/tours?ToursSearch[country_to_id]=<?php echo $item->country_to_id ?>" class="blue"><?php echo Countries::getCountry($item->country_to_id) ?></a>
                            <a href="/tours?ToursSearch[city_to_id]=<?php echo $item->city_to_id ?>"><?php echo Cities::getCity($item->city_to_id) ?></a>
                        </div>
                        <div class="tour-duration">
                            <p><?php echo $item->count_nights ?> ночей</p>
                            <p><?php echo $item->count_days ?>  дней</p>
                        </div>
                        <div class="tour-transport">
                            <i class="fa fa-<?php echo $item->transport->class ?>"></i>
                            <p><?php echo Cities::getCity($item->city_from_id) ?></p>
                            <p><?php echo $item->date_from ?></p>
                        </div>
                        <div class="tour-capacity">
                            <?php if(!$item->count_kids){ ?>
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
                                    <a href="#" class="login"><div class="tour-compare plus"></div></a>
                                    <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                                </div>
                            <?php }else{ ?>
                                <?php if(\frontend\modules\tours\Module::getFavorits($item->id)){ ?>
                                    <div>
                                        <a href="tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="tour-compare minus"></div></a>
                                        <div class="tour-like"><a href="tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                                    </div>
                                <?php }else{ ?>
                                    <div>
                                        <a href="tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="tour-compare plus"></div></a>
                                        <div class="tour-like"><a href="tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
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
        </section>
    </div>
</section>
