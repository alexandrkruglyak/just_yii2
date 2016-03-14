<?php

namespace frontend\modules\tourfirms\controllers;
use common\models\CustomerFeedback;
use common\models\ReviewsComment;
use common\models\ReviewsVotes;
use common\models\search\TourfirmsSearch;
use yii\bootstrap\Html;
use yii\data\Sort;
use common\models\search\TourfirmToursSearch;
use common\models\TourfirmsReviews;
use Yii;
use frontend\modules\user\models\ToursSearch;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use common\models\Tourfirms;
use yii\web\Controller;
use common\models\Article;
use yii\data\Pagination;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'rating'=>[
                    'label' => 'Рейтингу'
                ],
                'name'=>[
                    'label' => 'Алфавиту'
                ],
            ],
            'defaultOrder' => ['name' => SORT_DESC]
        ]);

        $searchModel = new TourfirmsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('tourfirms', [
            'dataProvider' => $dataProvider,
            'sort' => $sort
        ]);
    }

    public function actionView($slug)
    {
        $model = Tourfirms::find()->joinWith('tourfirmsPhon')->andWhere(['slug'=>$slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', ['model'=>$model]);
    }

    public function actionReviews($slug) {
        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
        $reviews = TourfirmsReviews::find()->where(['tourfirm_id'=>$model->id])->joinWith('user')->all();

        return $this->render('reviews', ['model'=>$model, 'reviews'=>$reviews]);
    }


    public function actionReviewcomm() {
        $model = Tourfirms::find()->andWhere(['id'=>yii::$app->request->get('tourfirm_id')])->one();
        $reviews = TourfirmsReviews::find()->where(['id'=>yii::$app->request->get('reviews_id')])->one();

        return $this->render('reviewcomm', ['model'=>$model, 'reviews'=>$reviews]);
    }

    public function actionSavereviewcomments(){
        $model = new ReviewsComment();
        if($model->load(yii::$app->request->post()) && $model->save()){
            echo Json::encode(
                [
                    'refresh'=>'""'
                ]
            );
        }
    }

    public function actionCreatereviews(){
            $model = new TourfirmsReviews();
            $find = $model->find()->where(['user_id'=>yii::$app->request->post('TourfirmsReviews')['user_id'],'tourfirm_id'=>yii::$app->request->post('TourfirmsReviews')['tourfirm_id']])->one();
            if($find){
                echo Json::encode(
                    [
                        'closeModal'=>'#leave-report-form',
                        'error'=>'Вы уже оставляли отзыв!'
                    ]
                );
            }else{
                if($model->load(yii::$app->request->post()) && $model->save()){
                    echo Json::encode(
                        [
                            'closeModal'=>'#leave-report-form',
                            'success'=>' '
                        ]
                    );
                }
            }
    }

    public function actionSavevotes(){
        $param = yii::$app->request->get();
        $model = ReviewsVotes::find()->where(['user_id'=>$param['user_id'],'reviews_id'=>$param['reviews_id']])->all();
        if(!$model){
            if(ReviewsVotes::saveVotes($param)){
                echo Json::encode(
                    [
                        'refresh' => '""',
                    ]
                );
            }
        }
        else {
            echo Json::encode(
                [
                    'errorVotes' => ' ',
                ]
            );
        }
    }

    public function actionManagers($slug) {
        $model = Tourfirms::find()->joinWith('managers')->andWhere(['slug'=>$slug])->one();
        return $this->render('managers', ['model'=>$model]);
    }

    public function actionTours($slug) {
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

        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
//        dump($model);

        $searchModel = new TourfirmToursSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $model->id);

        return $this->render('tours', ['model'=>$model, 'dataProvider'=>$dataProvider,'sort'=>$sort]);
    }

    public function actionFeedback(){
        $model = new CustomerFeedback;
        if($model->load(Yii::$app->request->post()) && $model->save()){
                echo Json::encode(
                    [
                        'success'=>' '
                    ]
                );
        }
    }

    public function actionContact($slug) {
        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
        $modelFeedback = new CustomerFeedback;
        return $this->render('contact', ['model'=>$model, 'modelFeedback'=>$modelFeedback]);
    }

    public function actionArticle($slug) {
        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
        $query = Article::find()->where(['status' => 1, 'tourfirm_id'=>$model->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>1]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->where(['tourfirm_id'=>$model->id])
            ->all();

        $big = Article::find()->where(['is_big'=>1, 'tourfirm_id'=>$model->id])->one();
        if (!$big) {
            throw new NotFoundHttpException('Нет большой картинки, поставьте чекбокс is_big хотя бы на одной новости');
        }
        return $this->render('news', [
            'model'=>$model,
            'models' => $models,
            'pages' => $pages,
            'big'=>$big
        ]);
    }

}
