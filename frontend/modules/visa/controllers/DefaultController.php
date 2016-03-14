<?php

namespace frontend\modules\visa\controllers;

use common\models\search\VisaSearch;
use common\models\VisaFavorites;
use common\models\VisaOrder;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use common\models\Visa;
use yii\web\Controller;
use yii\data\Sort;
use yii;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'date_create'=>[
                    'label' => 'Дате добавления'
                ],
                'price'=>[
                    'label' => 'Цене'
                ],
            ],
            'defaultOrder' => ['date_create' => SORT_DESC]
        ]);
        $searchModel = new VisaSearch();
        $dataProvider = $searchModel->searchFront(\Yii::$app->request->queryParams);

        return $this->render('visa',[
            'dataProvider'=>$dataProvider,
            'sort'=>$sort,
        ]);

    }

    public function actionView($slug)
    {
        $model = Visa::find()->andWhere(['slug'=>$slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', ['model'=>$model]);
    }

    public function actionFavorits(){
        $model = new VisaFavorites();
        if(yii::$app->request->get('save') == 1){
            $model->user_id = user()->id;
            $model->visa_id = yii::$app->request->get('visa_id');
            if($model->save()){
                echo yii\helpers\Json::encode(['refresh'=>'""']);
            }
        }
        else{
            if($model->deleteAll(['visa_id'=>yii::$app->request->get('visa_id')])) {
                echo yii\helpers\Json::encode(['refresh'=>'""']);
            }
        }
    }

    public function actionOrder(){
        $model = new VisaOrder();
        $find = $model->find()->where(['user_id'=>yii::$app->request->post('VisaOrder')['user_id'],'visa_id'=>yii::$app->request->post('VisaOrder')['visa_id']])->one();
        if($find){
            echo Json::encode(
                [
                    'closeModal'=>'#order_visa',
                    'error'=>'Вы уже заказали эту визу! '
                ]
            );
        }else{
            if($model->load(yii::$app->request->post()) && $model->save()){
                echo Json::encode(
                    [
                        'closeModal'=>'#order_visa',
                        'success'=>' '
                    ]
                );
            }
        }
    }
}
