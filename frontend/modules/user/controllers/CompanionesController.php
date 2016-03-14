<?php

namespace frontend\modules\user\controllers;

use common\models\CompanionesCompany;
use Yii;
use common\models\Companiones;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanionesController implements the CRUD actions for Companiones model.
 */
class CompanionesController extends Controller
{
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
     * Lists all Companiones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $myCompaniones = Companiones::find()->joinWith('myCompaniones')->where(['tbl_companiones.user_id'=>user()->id])->all();
        $this->layout = '/profile';
        $dataProvider = new ActiveDataProvider([
            'query' => Companiones::find()->where(['user_id'=>user()->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'myCompaniones' => $myCompaniones
        ]);
    }

    /**
     * Displays a single Companiones model.
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
     * Creates a new Companiones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = '/profile';
        $model = new Companiones();
        $m = new CompanionesCompany;
        $myCompaniones = Companiones::find()->joinWith('myCompaniones')->where(['tbl_companiones.user_id'=>user()->id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'myCompaniones' => $myCompaniones]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'myCompaniones' => $myCompaniones,
                'm' => $m,
            ]);
        }
    }

    /**
     * Updates an existing Companiones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = '/profile';
        $model = $this->findModel($id);
        $findCom = CompanionesCompany::find()->where(['companion_id'=>$id])->one();
        $m = CompanionesCompany::findOne($findCom->id);
        $myCompaniones = Companiones::find()->joinWith('myCompaniones')->where(['tbl_companiones.user_id'=>user()->id])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Companiones::updateCompanionesCompany($model->id, Yii::$app->request->post('CompanionesCompany'));
            return $this->redirect(['view', 'id' => $model->id,'myCompaniones' => $myCompaniones,]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'myCompaniones' => $myCompaniones,
                'm' => $m,
            ]);
        }
    }

    /**
     * Deletes an existing Companiones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->layout = '/profile';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Companiones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companiones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companiones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
