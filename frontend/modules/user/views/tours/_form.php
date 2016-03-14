<?php
use common\models\Transports;
use yii\helpers\Html;
use common\models\User;
use yii\helpers\ArrayHelper;
use common\models\Tours;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Tours */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="wrapper">
    <div class="wrapper-inner">
        <div class="tours-form">
            <div class="block-user">
            <?php $form = ActiveForm::begin(); ?>
            <?php if(userModel()->isUserTourOperator()) { ?>
                <?php echo $form->field($model, 'user_id')->dropDownList(User::getManagersOfCompany(), ['prompt' => 'Менеджер'])->label(false) ?>
            <?php }else{ ?>
            <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
            <?php }?>
            <?= $form->field($model, 'title')->textInput(['placeholder'=>'Название тура','maxlength' => true])->label(false) ?>

            <?= $form->field($model, 'price')->textInput(['placeholder'=>'Стоимость','maxlength' => true])->label(false) ?>

            <?php echo $form->field($model, 'country_to_id')->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\frontend\controllers\SiteController::getCountries(),'country_id','name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Страна назначения','class' => 'select user-form firm-form', 'id'=>'cat-id'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label(false);
            ?>
            <?php echo $form->field($model, 'city_to_id')->widget(DepDrop::classname(), [
                'type' => 2,
                'options' => ['id'=>'subcat-id'],
                'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder' => 'Выберите город назначения',
                    'url' => Url::to(['/site/cities'])
                ]
            ])->label(false);
            ?>

            <?php echo $form->field($model, 'country_from_id')->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\frontend\controllers\SiteController::getCountries(),'country_id','name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Страна вылета','class' => 'select user-form firm-form', 'id'=>'cat-id-id'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label(false);
            ?>

            <?php echo $form->field($model, 'city_from_id')->widget(DepDrop::classname(), [
                'type' => 2,
                'options' => ['id'=>'subcat-id-id'],
                'pluginOptions'=>[
                    'depends'=>['cat-id-id'],
                    'placeholder' => 'Выберите город вылета',
                    'url' => Url::to(['/site/cities'])
                ]
            ])->label(false);
            ?>




            <?php echo $form->field($model, 'date_from')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ])->label() ?>

            <?php echo $form->field($model, 'count_old')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Взрослых'])->label(false) ?>
            <?php echo $form->field($model, 'count_kids')->dropDownList(range(0,12), ['prompt' => 'Детей'])->label(false) ?>

            <?php echo $form->field($model, 'count_days')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Дней'])->label(false) ?>
            <?php echo $form->field($model, 'count_nights')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Ночей'])->label(false) ?>

            <?php
            $transports = Transports::find()->all();
            $items = ArrayHelper::map($transports,'id','type');
            ?>
            <?php echo $form->field($model, 'transport_type')->dropDownList($items, ['prompt' => 'Вид транспорта'])->label(false) ?>

            <?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>\common\models\Tourfirms::getTourfirmId(user()->id)])->label(false) ?>
            <?= $form->field($model, 'hot')->checkbox(['value' => 1, 'label' => 'Горащий тур']) ?>

            <?php echo $form->field($model, 'body')->widget(
                \yii\imperavi\Widget::className(),
                [
                    'plugins' => ['fullscreen', 'fontcolor', 'video'],
                    'options' => [
                        'minHeight' => 400,
                        'maxHeight' => 400,
                        'buttonSource' => true,
                        'convertDivs' => false,
                        'removeEmptyTags' => false,
                        'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
                    ]
                ]
            ) ?>

            <?php /*echo $form->field($model, 'thumbnail')->widget(
        Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    */?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        </div>
    </div>
</div>
