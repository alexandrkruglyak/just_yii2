<?php
use common\models\ReviewsVotes;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>
<section class="company-page with-rating">
    <div class="content-wrapper">
        <h1><?php echo $model->name ?><div><span class="rating-grade green">5.00</span><a href="#">рейтинг фирмы</a></div></h1>
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmReviewsWidget::widget(['id'=>$model->id, 'slug'=>$model->slug]) ?>
        <ul class="tabs-container">
            <li><a href="/tourfirm/<?php echo $model->slug ?>">описание</a></li>
            <li class="active"><a href="/tourfirm/<?php echo $model->slug ?>/reviews">отзывы</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/contact">контакты</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/article">новости/акции</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/managers">менеджеры</a></li>
            <li><a href="/tourfirm/<?php echo $model->slug ?>/tours">туры (<?php echo count($model->tours) ?>)</a></li>
        </ul>
        <div class="company-reports company-report-full">
            <div class="report">
                <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews(\common\models\Tourfirms::getPercentVotes($reviews->id)) ?>"><?php echo \common\models\Tourfirms::getPercentVotes($reviews->id)?></span>
                <div class="box">
                    <span class="datemark"><?php echo rus_date('d F Y', $reviews->date_create) ?></span>
                    <p><?php echo $reviews->comment ?></p>
                    <div class="report-photos">
                        <img src="" alt="" style="background: black;">
                    </div>
                    <div class="actions">
                        <?php if(!user()->id){ ?>
                            <a href="#" class="like login"><i class="fa fa-thumbs-up"></i><?php echo ReviewsVotes::getCountVotes(1, $reviews->id) ?></a>
                            <a href="#" class="unlike login"><i class="fa fa-thumbs-down"></i><?php echo ReviewsVotes::getCountVotes(0, $reviews->id) ?></a>
                        <?php }else{ ?>
                            <a href="/tourfirms/savevotes?reviews_id=<?php echo $reviews->id ?>&user_id=<?php echo user()->id ?>&vote=1" class="like ajax-link"><i class="fa fa-thumbs-up"></i><?php echo ReviewsVotes::getCountVotes(1, $reviews->id) ?></a>
                            <a href="/tourfirms/savevotes?reviews_id=<?php echo $reviews->id ?>&user_id=<?php echo user()->id ?>&vote=0" class="unlike ajax-link"><i class="fa fa-thumbs-down"></i><?php echo ReviewsVotes::getCountVotes(0, $reviews->id) ?></a>
                        <?php } ?>
                        <p><i class="fa fa-user"></i>Автор отзыва: <a href="#"><?php echo $reviews->user->firstname  ?></a></p>
                    </div>
                </div>
            </div>
            <?php if($reviews->comments) { ?>
                <h1>Комментарии к отзыву</h1>
            <?php }else{ ?>
                <h1>Комментарии к отзыву отсутсвуют</h1>
            <?php } ?>
            <?php foreach($reviews->comments as $comment){ ?>
                <div class="report-comment">
                    <div>
                        <p><?php echo $comment->comment ?></p>
                    </div>
                    <p>
                        <a href="#"><?php echo $comment->user->username ?></a><span> </span><span class="comment-datemark"><?php echo rus_date('d F Y', $comment->date_create) ?></span>
                    </p>
                </div>
            <?php } ?>
            <h1>Оставить комментарий</h1>
            <?php
            $form = ActiveForm::begin(['action'=>'/tourfirms/savereviewcomments','id'=>'report-leave-comment','options'=>['class'=>'ajax-form']]);
            $model = new \common\models\ReviewsComment();
            echo $form->field($model, 'comment')->textarea(['cols'=>'30', 'rows'=>'10', 'placeholder'=>'Ваш комментарий...'])->label(false);
            echo $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false);
            echo $form->field($model, 'reviews_id')->hiddenInput(['value'=>$reviews->id])->label(false);
            echo $form->field($model, 'date_create')->hiddenInput(['value'=>time()])->label(false);
            ?>
            <div class="button-line">
                <?php
                echo Html::submitButton('<i class="fa fa-picture-o"></i> добавить изображение',['class'=>'button yellow']);
                echo Html::submitButton('отправить комментарий',['class'=>'button yellow']);
                ?>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
</section>