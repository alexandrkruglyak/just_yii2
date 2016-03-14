<?php

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

</div>
