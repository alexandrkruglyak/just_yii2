<?php

namespace common\models;

use common\models\query\TourfirmsQuery;
use Yii;
use trntv\filekit\behaviors\UploadBehavior;


/**
 * This is the model class for table "tbl_tourfirms".
 *
 * @property integer $id
 * @property integer $rating
 * @property string $description
 * @property string $address
 * @property string $name
 * @property string $phone
 */
class Tourfirms extends \yii\db\ActiveRecord
{
    public $phone1;
    public $phone2;
    public $phone3;
    public $phone4;
    public $attachments;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tourfirms';
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'tourfirmAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
//            [
//                'class' => UploadBehavior::className(),
//                'attribute' => 'thumbnail',
//                'pathAttribute' => 'thumbnail_path',
//                'baseUrlAttribute' => 'thumbnail_base_url'
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating','touroperator_id'], 'integer'],
            [['description','legal_info','slug'], 'string'],
            [['address', 'name'], 'string', 'max' => 200],
            [['attachments'], 'safe']
        ];
    }

    public function getTourfirmAttachments()
    {
        return $this->hasMany(TourfirmAttachment::className(), ['tourfirm_id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rating' => 'Rating',
            'description' => 'Description',
            'address' => 'Address',
            'name' => 'Name',
            'phone' => 'Phone',
            'legal_info' => 'Uridicheskaya info',
        ];
    }

    public static function find()
    {
        return new TourfirmsQuery(get_called_class());
    }

    public function getManagers() {
        return $this->hasMany(TouroperatorsManagers::className(), ['profile_touroperator_id'=>'touroperator_id']);
    }

    public function getTours() {
        return $this->hasMany(Tours::className(), ['tourfirm_id'=>'id']);
    }

    public function getTourfirmsPhon(){
        return $this->hasOne(TourfirmsPhons::className(), ['tourfirm_id' =>'id']);
    }

    public function getTourfirmWorkTime(){
        return $this->hasOne(TourfirmWorkTime::className(), ['tourfirm_id' =>'id']);
    }

    public function getTourfirmReviews(){
        return $this->hasMany(TourfirmsReviews::className(), ['tourfirm_id'=>'id']);
    }

    public static function getTourfirmId($id){
        if($id){
            if(userModel()->isUserTourOperator()){
                $userId =  $id;
            }
            else{
                $model = TouroperatorsManagers::find()->where(['profile_manager_id'=>$id])->one();
                $userId = $model->profile_touroperator_id;
            }
            $model = Tourfirms::find()->where(['touroperator_id'=>$userId])->one();
            if($model){
                return $model->id;
            }
            else{
                return false;
            }
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $tourfirmId = self::getTourfirmId(user()->id);
        if ($insert && yii::$app->request->post()) {
            $TourfirmsPhons = new TourfirmsPhons();
            $TourfirmsPhons->tourfirm_id = $tourfirmId;
            $TourfirmsPhons->default = yii::$app->request->post('TourfirmsPhons')['default'];
            $TourfirmsPhons->mts = yii::$app->request->post('TourfirmsPhons')['mts'];
            $TourfirmsPhons->life = yii::$app->request->post('TourfirmsPhons')['life'];
            $TourfirmsPhons->viber = yii::$app->request->post('TourfirmsPhons')['viber'];
            $TourfirmsPhons->skype = yii::$app->request->post('TourfirmsPhons')['skype'];
            $TourfirmsPhons->icq = yii::$app->request->post('TourfirmsPhons')['icq'];
            $TourfirmsWorkTime = new TourfirmWorkTime();
            $TourfirmsWorkTime->tourfirm_id = $tourfirmId;
            $TourfirmsWorkTime->monday = yii::$app->request->post('TourfirmWorkTime')['monday'];
            $TourfirmsWorkTime->tuesday = yii::$app->request->post('TourfirmWorkTime')['tuesday'];
            $TourfirmsWorkTime->wednesday = yii::$app->request->post('TourfirmWorkTime')['wednesday'];
            $TourfirmsWorkTime->thursday = yii::$app->request->post('TourfirmWorkTime')['thursday'];
            $TourfirmsWorkTime->friday = yii::$app->request->post('TourfirmWorkTime')['friday'];
            $TourfirmsWorkTime->saturday = yii::$app->request->post('TourfirmWorkTime')['saturday'];
            $TourfirmsWorkTime->sunday =yii::$app->request->post('TourfirmWorkTime')['sunday'];
            foreach([$TourfirmsPhons, $TourfirmsWorkTime] as $model) {
                $model->save();
            }
        }
    }

    public static function updateData($id, $post){
        $modelPhons = new TourfirmsPhons();
        $modelPhons->updateAll(
            [
                'default'=>$post['TourfirmsPhons']['default'],
                'mts'=>$post['TourfirmsPhons']['mts'],
                'life'=>$post['TourfirmsPhons']['life'],
                'icq'=>$post['TourfirmsPhons']['icq'],
                'viber'=>$post['TourfirmsPhons']['viber'],
            ],
            [
                'tourfirm_id'=>$id
            ]
        );
        $modelWorkTime = new TourfirmWorkTime();
        $modelWorkTime->updateAll(
            [
                'monday'=>$post['TourfirmWorkTime']['monday'],
                'tuesday'=>$post['TourfirmWorkTime']['tuesday'],
                'wednesday'=>$post['TourfirmWorkTime']['wednesday'],
                'thursday'=>$post['TourfirmWorkTime']['thursday'],
                'friday'=>$post['TourfirmWorkTime']['friday'],
                'saturday'=>$post['TourfirmWorkTime']['saturday'],
                'sunday'=>$post['TourfirmWorkTime']['sunday'],
            ],
            [
                'tourfirm_id'=>$id
            ]
        );
    }

    public static function getPercentVotes($reviews_id) {
        $model = ReviewsVotes::find()->where(['reviews_id'=>$reviews_id])->all();
        $votes = [];
        foreach($model as $vote){
            if($vote->vote == 1){
                $votes[] = $vote->vote;
            }
        }
        $num  = round(count($votes) / count($model) * 5, 2);
        $num = $num.'00000';
        $newNum = substr($num, 0, 3);
        if(is_float((float)$newNum)){
            $newNum = $newNum.'0';
        }
        $newNum = substr_replace($newNum, ".", 1, 1);
        return $newNum;
    }
}
