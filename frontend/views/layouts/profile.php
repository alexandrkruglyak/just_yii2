<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
use yii\helpers\Html;
/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>

    <section class="office-container">
    <aside class="menu expanded">
        <a href="#" id="toggle-menu"><i class="fa fa-tachometer"></i></a>
        <div class="about">
            <?php if (userModel()->userProfile->avatar_path){ ?>
                <?php echo Html::img(
                    Yii::$app->glide->createSignedUrl([
                        'glide/index',
                        'path' => userModel()->userProfile->avatar_path,
                        'w' => 100
                    ], true),
                    ['alt' => '']
                ) ?>
            <?php }else{ ?>
            <img src="/v1/img/avatar.jpg" alt="John Smith">
            <?php } ?>
            <p class="name hideable"><?php echo userModel()->userProfile->firstname; ?> <?php echo userModel()->userProfile->lastname; ?></p>
            <p class="hideable"><em>
                    <?php if(userModel()->isUserTourOperator()){
                        echo 'Тур.оператор';}
                        elseif(userModel()->isUserTourManager()){
                        echo "Менеджер";
                    }
                    else{
                        echo 'Турист';
                    } ?>
                </em></p>
        </div>
        <div class="menu-items">
            <?php

                echo Menu::widget([
                    'items' => [
                        ['label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Турфирма<i class="fa fa-angle-right"></i></span>', 'url' => ['/profile/tourfirms'], 'visible' => userModel()->isUserTourOperator()],
//                        ['label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Панель управления<i class="fa fa-angle-right"></i></span>', 'url' => ['site/index'], 'visible' => userModel()->isUserTourOperator()],
                        ['label' => '<span class="pic"><i class="fa fa-commenting"></i></span><span class="hideable">Мои заявки<span class="counter"><sub>+</sub>5</span><i class="fa fa-angle-right"></i></span>', 'url' => ['site/index'] , 'visible' => userModel()->isUserTurist()],
                        ['label' => '<span class="pic"><i class="fa fa-heart"></i></span><span class="hideable">Избранные туры<i class="fa fa-angle-right"></i></span>', 'url' => ['/profile/toursfavorites'], 'visible' => userModel()->isUserTurist()],
                        ['label' => '<span class="pic"><i class="fa fa-heart"></i></span><span class="hideable">Избранные визы<i class="fa fa-angle-right"></i></span>', 'url' => ['/profile/visafavorites'], 'visible' => userModel()->isUserTurist()],
                        ['label' => '<span class="pic"><i class="fa fa-star"></i></span><span class="hideable">Мои отзывы<i class="fa fa-angle-right"></i></span>', 'url' => ['site/index'] , 'visible' => userModel()->isUserTurist()],
                        ['label' => '<span class="pic"><i class="fa fa-smile-o"></i></span><span class="hideable">Мои попутчики<i class="fa fa-angle-right"></i></span>', 'url' => ['/profile/companiones'], 'visible' => userModel()->isUserTurist()],
                        [
                            'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Данные компании</span>',
                            'url' => ['/user/default/index'],
                            'linkOptions' => [],
                            'visible' => userModel()->isUserTourOperator()
                        ],
                        [
                            'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Данные акаунта</span>',
                            'url' => ['/user/default/settings'],
                            'linkOptions' => [],
                            'visible' => userModel()->isUserTourOperator()
                        ],
                        [
                            'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Туры компании</span>',
                            'url' => ['/user/tours/index'],
                            'linkOptions' => [],
                            'visible' => userModel()->isUserTourOperator() || userModel()->isUserTourManager()
                        ],
                        [   'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Отзывы</span>',
                            'url' => ['/user/tourfirmreviews/index'],
                            'linkOptions' => [],
                            'visible' => userModel()->isUserTourOperator() || userModel()->isUserTourManager()
                        ],
                        [
                            'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Менеджеры компании</span>',
                            'url' => ['/user/manager/index'],
                            'linkOptions' => [],
                            'visible' => userModel()->isUserTourOperator()
                        ],
                        [
                            'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Новости</span>',
                            'url' => ['/user/news/index'],
                            'linkOptions' => [],
                            'visible' => userModel()->isUserTourOperator()
                        ],
//                        [
//                            'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Контактные данные</span>',
//                            'url' => ['#'],
//                            'linkOptions' => [],
//                            'visible' => userModel()->isUserTourOperator()
//                        ],
                        [
                            'label' => '<span class="pic"><i class="fa fa-tachometer"></i></span><span class="hideable">Визы</span>',
                            'url' => ['/user/visa'],
                            'linkOptions' => [],
                            'visible' => userModel()->isUserTourOperator() || userModel()->isUserTourManager()
                        ],
                        ['label' => '<span class="pic"><i class="fa fa-comments-o"></i></span><span class="hideable">Сообщения<span class="counter"><sub>+</sub>99</span><i class="fa fa-angle-right"></i></span>', 'url' => ['/user/default/messages']],
//                        ['label' => '<span class="pic"><i class="fa fa-cog"></i></span><span class="hideable">Настройки<i class="fa fa-angle-right"></i></span>', 'url' => ['/user/default/index']],
//                        ['label' => '<span class="pic"><i class="fa fa-cog"></i></span><span class="hideable">Настройки акаунта<i class="fa fa-angle-right"></i></span>', 'url' => ['/user/default/settings']],
                        ['label' => '<span class="pic"><i class="fa fa-power-off"></i></span><span class="hideable">Выйти<i class="fa fa-angle-right"></i></span>', 'url' => ['site/index']],
                    ],
                    'encodeLabels' => false
                ]);

                ?>
        </div>
    </aside>
    <div class="content">
    <section>
        <div class="wrapper">

        <?php if (Yii::$app->session->hasFlash('alert')): ?>
            <?php echo \yii\bootstrap\Alert::widget([
                'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
            ]) ?>
        <?php endif; ?>

        <?php echo $content ?>


        </div>
    </section>
<?php $this->endContent() ?>