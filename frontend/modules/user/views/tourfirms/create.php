<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tourfirms */

$this->title = 'Create Tourfirms';
$this->params['breadcrumbs'][] = ['label' => 'Tourfirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tourfirms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPhons' => $modelPhons,
        'modelWorkTime' => $modelWorkTime,

    ]) ?>

</div>
