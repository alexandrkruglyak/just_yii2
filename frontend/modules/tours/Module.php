<?php

namespace frontend\modules\tours;

use common\models\ToursFavorits;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\tours\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function getFavorits($id){
        $model = ToursFavorits::find()->where(['tour_id'=>$id, 'user_id'=>user()->id])->one();
        if($model){
            return 1;
        }
        else{
            return 0;
        }
    }
}
