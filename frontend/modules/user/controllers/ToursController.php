<?php

namespace frontend\modules\user\controllers;

use common\models\search\TourfirmsUserSearch;
use common\models\search\TourfirmToursSearch;
use common\models\Tourfirms;
use common\models\TourfirmsPhons;
use common\models\TouroperatorsManagers;
use Yii;
use common\models\Tours;
use frontend\modules\user\models\ToursSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToursController implements the CRUD actions for Tours model.
 */
class ToursController extends Controller
{

    public function getTourfirms(){
        $tourfirm_id = Tourfirms::getTourfirmId(user()->id);
        $modelTourFirm = Tours::find()->where(['tourfirm_id'=>$tourfirm_id])->all();
        return $modelTourFirm;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tours models.
     * @return mixed
     */
    public function actionIndex()
    {

        $this->layout = '/profile';
        $searchModel = new TourfirmToursSearch();
        $flagTourfirm = Tourfirms::getTourfirmId(user()->id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$flagTourfirm);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->getTourfirms(),
            'flagTourfirm' => $flagTourfirm
        ]);
    }

    /**
     * Displays a single Tours model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '/profile';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tours model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = '/profile';
        $model = new Tours();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = '/profile';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tours model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
