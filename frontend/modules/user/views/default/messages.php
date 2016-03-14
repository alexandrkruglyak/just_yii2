<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
    use kartik\select2\Select2;
    use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('frontend', 'User Settings');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="head-symbol"><i class="fa fa-commenting"></i></div>
<h1><?php echo Yii::t('frontend', 'Сообщения') ?></h1>
<?= vision\messages\widgets\PrivateMessageKushalpandyaWidget::widget() ?>

