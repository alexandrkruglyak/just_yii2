<?php

namespace frontend\modules\visa;

use common\models\VisaFavorites;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\visa\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function getFavorits($id){
        $model = VisaFavorites::find()->where(['visa_id'=>$id, 'user_id'=>user()->id])->one();
        if($model){
            return 1;
        }
        else{
            return 0;
        }
    }
}
