<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VisaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-index">
    <div class="head-symbol"><i class="fa fa-commenting"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($flagTourfirm){ ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Visa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'description',
            'slug',
            'price',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'class' => 'visa-list'
        ],
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item',
    ]) ?>

</div>
<?php }else{ ?>
    <p>
        Турфирма еще не создана!
    </p>
<?php } ?>
