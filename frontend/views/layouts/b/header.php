<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 24.12.2015
 * Time: 16:52
 */
?>
<header>
    <div class="wrapper">
        <a href="/" class="logo">
            <div></div>
            <span>все туры Беларуси</span></a>
        <div class="burger-trigger"></div>
        <nav>
            <a href="/tours" title="">Туры</a>
            <a href="/tourfirms" title="">Турфирмы</a>
            <a href="/visa" title="">Визы</a>
            <a href="/countries" title="">Страны</a>
            <a href="/companions" title="">Попутчики</a>
            <a href="/article" title="">Новости</a>
        </nav>
        <div class="login-buttons">
            <?php if (!user()->getIsGuest()) { ?>
                <?php echo l('Личный кабинет', \frontend\modules\user\Module::ProfileUrl()) ?>
                <?php echo l('Выход', \frontend\modules\user\Module::LogoutUrl()) ?>
            <?php } else { ?>
                <?php echo l('Регистрация', \frontend\modules\user\Module::SignUpUrl()) ?>
                <?php echo l('Вход', '#', ['class' => 'login']) ?>
            <?php } ?>
        </div>
    </div>
</header>
<div class="header-spacer"></div>
