<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Json;
?>
<?php
if(!user()->id){ ?>
<a href="/tourfirm/createreviews" class="button yellow login">оставить отзыв</a>

 <?php }else{ ?>
<a href="#" class="button yellow report-trigger">оставить отзыв</a>
<?php }?>

<div class="w_popup report_popup">
    <i class="fa fa-times popup_close"></i>
    <div class="popup_head">Оставить отзыв</div>
    <?php $form = ActiveForm::begin([
        'action'=>'/tourfirm/createreviews',
        'id'=>'leave-report-form',
        'options' => [
            'class' => 'ajax-form'
        ]]);
    ?>
    <?php $modelRev = new \common\models\TourfirmsReviews() ?>
    <?= $form->field($modelRev, 'comment')->textarea(['cols'=>30, 'rows'=>10,'placeholder'=>'Ваш отзыв'])->label(false) ?>
    <?= $form->field($modelRev, 'tourfirm_id')->hiddenInput(['value'=>$id])->label(false) ?>
    <?= $form->field($modelRev, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
    <?= $form->field($modelRev, 'status')->hiddenInput(['value'=>0])->label(false) ?>
    <?= $form->field($modelRev, 'slug')->hiddenInput(['value'=>$slug])->label(false) ?>
    <a href="" class="yellow button"><i class="fa fa-picture-o"></i>загрузить документ</a>
    <?= Html::submitButton('Отправить') ?>
    <?php ActiveForm::end(); ?>
</div>