<?php
    use yii\widgets\LinkPager;
    use common\models\Countries;
    use common\models\Cities;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
?>

<div class="content-wrapper with-counter">
<h1>Все туры<span class="country-count"><?php echo  $dataProvider->getTotalCount() ?></span></h1>
<p>Туры всех турфирм из нашего каталога</p>
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
$option = '';
if(isset( yii::$app->request->get('ToursSearch')['country_to_id'])){
    $option = [yii::$app->request->get('ToursSearch')['country_to_id'] => ['selected ' => true ]];
}
echo $form->field($modelCountries, 'searchCountries')->dropDownList($items, ['prompt'=>'Выберете страну',   'options' =>$option])->label(false);
ActiveForm::end();
?>
<p class="sort">Сортировать по:<?php echo $sort->link('created_at')?><?php echo $sort->link('count_nights')?><?php echo $sort->link('price')?></p>
<ul class="tours-list">
    <?php foreach($dataProvider->getModels() as $item){ ?>
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
</div>

    <?php echo LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
    ?>
</section>
</div>