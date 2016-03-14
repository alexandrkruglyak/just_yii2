<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\login;

use yii\base\Widget;
use frontend\modules\user\models\LoginForm;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class SWidget extends Widget{
    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        $model = new LoginForm();
        if (Yii::$app->request->isAjax) {
            $model->load($_POST);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('@frontend/modules/user/widgets/login/views/default',['model'=>$model]);
        }

    }

    public function goBack($defaultUrl = null)
    {
        return Yii::$app->getResponse()->redirect(Yii::$app->getUser()->getReturnUrl($defaultUrl));
    }
}


