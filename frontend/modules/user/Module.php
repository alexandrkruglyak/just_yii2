<?php

namespace frontend\modules\user;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\user\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function LogoutUrl(){
        return url('user/sign-in/logout');
    }

    public static function ProfileUrl()
    {
        return url('/user/default/index');
    }

    public static function SignUpUrl(){
        return url('user/sign-in/signup');
    }
}
