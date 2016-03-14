<?php
namespace frontend\controllers;

use common\models\Tours;
use common\models\UserIformation;
use Yii;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\Article;
use yii\web\NotFoundHttpException;
use common\models\Cities;
use yii\helpers\Json;
use common\models\Countries;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tours::find()->orderBy('published_at desc')->limit(6)->all(),
        ]);

        ;$big = Article::find()->where(['is_big'=>1])->one();
        if (!$big) {
            throw new NotFoundHttpException('Нет большой картинки, поставьте чекбокс is_big хотя бы на одной новости');
        }
        return $this->render('index',['big'=>$big,'tours' => $dataProvider]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options'=>['class'=>'alert-success']
                ]);
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'There was an error sending email.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionCities(){
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getCityList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getCityList($id){
        $data = Cities::find()->where(['country_id'=>$id])->all();
        $array = [];
        foreach($data as $item){
            $array[$item->id] = [
                'id'=>$item->id,
                'name' => $item->city
            ];
        }

        return $array;
    }

    public static function getCountries(){
        $countries = Countries::find()->all();
        return $countries;
    }

    public function actionNotuser() {
            echo Json::encode(
                [
                    'errorNotUser' => ' '
                ]
            );
    }

    public function actionInformations(){
        $model = new UserIformation();
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
