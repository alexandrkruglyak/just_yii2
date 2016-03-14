<?php
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use common\models\Countries;
use yii\helpers\ArrayHelper;
?>

<section class="tours-page">
    <div class="content-wrapper with-counter">
        <h1>Туристические фирмы<span class="country-count"><?php echo $dataProvider->getTotalCount() ?></span></h1>
        <p>Все туристические фирмы Беларуси</p>
        <?php
        $form = ActiveForm::begin([
            'id'=>'tour-country-filter',
            'options'=>[
                'class'=>'regular-form'
            ]
        ]);
        $modelCountries = new Countries();
        $countries = Countries::find()->all();
        $items = ArrayHelper::map($countries, 'country_id', 'name');
        echo $form->field($modelCountries, 'searchCountries')->dropDownList($items, ['prompt'=>'Выберете страну',   'options' => [ yii::$app->request->get('TourSearch')['country_id'] => ['selected ' => true]]])->label(false);
        ActiveForm::end();
        ?>
        <p class="sort">Сортировать по:<?php echo $sort->link('name')?><?php echo $sort->link('rating')?></p>

        <div class="tourfirms">
            <?php foreach($dataProvider->getModels() as $item){ ?>

                <div class="container">
                <div>
                    <a href="/tourfirm/<?php echo $item->slug ?>" class="title"><?php echo $item->name ?></a>
                    <div>
                        <div class="tour-rate">
                            <div class="green rating-grade"><?php echo $item->rating ?></div>
                            <a href="#">рейтинг фирмы</a>
                            <a href="tourfirm/<?php echo $item->slug ?>/reviews">отзывы (<?php echo count($item->tourfirmReviews)?>)</a>
                        </div>
                        <div class="likes">
                            <span class="pic"></span>
                            <span>50</span>
                        </div>
                    </div>
                    <p><?php echo $item->description ?></p>
                    <div class="location">
                        <a href="#"><i class="fa fa-map-marker"></i><?php echo $item->address ?></a>
                    </div>
                    <div class="phones">
                        <?php if($item->tourfirmsPhon->default){ ?><span><?php echo $item->tourfirmsPhon->default ?></span><?php }?>
                        <?php if($item->tourfirmsPhon->mts){ ?><span class="mts"><?php echo $item->tourfirmsPhon->mts ?></span><?php }?>
                        <?php if($item->tourfirmsPhon->life){ ?> <span class="life"><?php echo $item->tourfirmsPhon->life ?></span><?php }?>
                        <?php if($item->tourfirmsPhon->viber){ ?><span class="viber"><?php echo $item->tourfirmsPhon->viber ?></span><?php }?>
                    </div>
                </div>
                <div class="pics">
                    <img src="img/tourfirm-photo.jpg" width='200' height="140" alt="">
                    <img src="img/tourfirm-photo.jpg" width='200' height="140" alt="">
                    <img src="img/tourfirm-photo.jpg" width='200' height="140" alt="">
                    <img src="img/tourfirm-photo.jpg" width='200' height="140" alt="">
                </div>
            </div>
            <?php } ?>
        </div>
        <?php echo LinkPager::widget([
            'pagination' => $dataProvider->pagination,
        ]);
        ?>
    </div>
</section>