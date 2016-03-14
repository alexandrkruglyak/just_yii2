<?php

namespace frontend\modules\tours\controllers;

use common\models\ToursFavorits;
use common\models\ToursOrder;
use yii;
use common\models\search\ToursSearch;
use yii\web\NotFoundHttpException;
use common\models\Tours;
use yii\web\Controller;
use yii\data\Pagination;
use yii\data\Sort;

class DefaultController extends Controller
{
    public function actionIndex()
    {

        $sort = new Sort([
            'attributes' => [
                'created_at'=>[
                    'label' => 'Дате создания'
                ],
                'price'=>[
                    'label' => 'Цене'
                ],
                'count_nights'=>[
                    'label' => 'Количества дней'
                ],
            ],
            'defaultOrder' => ['created_at' => SORT_ASC]
        ]);

        $searchModel = new ToursSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('tours',[
            'dataProvider'=>$dataProvider,
            'sort'=>$sort,

        ]);
    }

    public function actionView($slug)
    {
        $model = Tours::find()->andWhere(['slug'=>$slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', ['model'=>$model]);
    }

    public function actionFavorits(){
        $model = new ToursFavorits();
        if(yii::$app->request->get('save') == 1){
            $model->user_id = user()->id;
            $model->tour_id = yii::$app->request->get('tour_id');
            if($model->save()){
                echo yii\helpers\Json::encode(['refresh'=>'""']);
            }
        }
        else{
            if($model->deleteAll(['tour_id'=>yii::$app->request->get('tour_id')])) {
               echo yii\helpers\Json::encode(['refresh'=>'""']);
            }
        }
    }

    public function actionOrder(){

        $model = new ToursOrder();
        $find = $model->find()->where(['user_id'=>yii::$app->request->post('ToursOrder')['user_id'],'tour_id'=>yii::$app->request->post('ToursOrder')['tour_id']])->one();
        if($find){
                echo yii\helpers\Json::encode(
                    [
                        'closeModal'=>'#order_tour',
                        'error'=>'Вы уже заказали этот тур! '
                    ]
                );
        }else{
            if($model->load(yii::$app->request->post()) && $model->save()){
                echo yii\helpers\Json::encode(
                    [
                        'closeModal'=>'#order_tour',
                        'success'=>' '
                    ]
                );
            }
        }

//        dump(yii::$app->request->post());
    }
}
