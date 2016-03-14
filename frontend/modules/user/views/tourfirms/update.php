<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tourfirms */

$this->title = 'Update Tourfirms: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tourfirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tourfirms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPhons' => $modelPhons,
        'modelWorkTime' => $modelWorkTime,
    ]) ?>

</div>
