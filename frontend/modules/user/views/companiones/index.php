<?php

use common\models\Countries;
use common\models\Cities;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companiones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Companiones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'age_with',
            'age_to',
            'type_travel_id',
            // 'purpose_travel',
            // 'about_me',
            // 'about_traveler',
            // 'travel_location',
            // 'gender_traveler',
            // 'iterests',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
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

