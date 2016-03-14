<?php

namespace frontend\modules\companions\controllers;

use common\models\Companiones;
use yii\web\Controller;
use yii\data\Pagination;

class DefaultController extends Controller
{
    public function actionIndex()
    {

        $query = Companiones::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>2]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('companiones',
        [
            'model'=>$model,
            'pages'=>$pages
        ]);
    }
}
