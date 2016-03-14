<?php
use common\models\Countries;
use yii\widgets\LinkPager;
?>

<div class="content-wrapper companions">
    <h1>Попутчики<span class="companions-count head-count"><?php echo count($model) ?></span></h1>
    <p>Найди свою компанию!</p>
    <div class="tags-container">
        <span>лыжи<i class="fa fa-check"></i><i class="fa fa-times"></i></span>
        <span>лыжи<i class="fa fa-check"></i><i class="fa fa-times"></i></span>
        <span>лыжи<i class="fa fa-check"></i><i class="fa fa-times"></i></span>
        <span>лыжи<i class="fa fa-check"></i><i class="fa fa-times"></i></span>
        <span>лыжи<i class="fa fa-check"></i><i class="fa fa-times"></i></span>
        <span>лыжи<i class="fa fa-check"></i><i class="fa fa-times"></i></span>
    </div>
    <div class="companions-container">
        <?php foreach($model as $item){ ?>
        <article>
            <div class="main-info">
                <div class="creds">
                    <a href="#">
                        <img src="img/user-1.jpg" alt="">
                        <i class="fa fa-comment"></i>
                    </a>
                    <div>
                        <p class="name"><span><?php echo $item->myCompaniones->firstname." ".$item->myCompaniones->lastname ?></span><span class="age blue"><?php echo $item->myCompaniones->byear?> лет</span><span class="location"><?php echo Countries::getCountry($item->myCompaniones->country)?>, <?php echo \common\models\Cities::getCity($item->myCompaniones->country)?></span></p>
                        <div><i class="fa <?php echo $item->gender->class_gender ?>"></i>Ищу в попутчики <?php echo $item->gender->gender ?></div>
                        <div><i class="fa fa-user"></i>Возраст от <?php echo $item->age_with ?> до <?php echo $item->age_to ?> лет</div>
                    </div>
                </div>
                <div class="target">
                    <p class="destination">в <?php echo $item->travel_location ?></p>
                    <p><span>Цель поездки:</span> <?php echo $item->purpose_travel ?></p>
                    <p><span>О себе:</span> <?php echo $item->about_me ?></p>
                    <p><span>О попутчике:</span> <?php echo $item->about_traveler ?></p>
                </div>
            </div>
            <a href="#" class="tag">лыжи</a>
            <a href="#" class="tag">сноуборд</a>
        </article>
        <?php } ?>
       <?php echo LinkPager::widget([
        'pagination' => $pages,
        ]); ?>
    </div>
</div>