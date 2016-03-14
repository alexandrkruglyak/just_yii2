<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%tourfirms_reviews}}".
 *
 * @property integer $id
 * @property string $comment
 * @property integer $user_id
 * @property integer $tourfirm_id
 * @property integer $date_create
 */
class TourfirmsReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $updated_at;
    public $slug;

    public function behaviors()
    {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'value' => new Expression(time()),
            ],
        ];
    }
    public static function tableName()
    {
        return '{{%tourfirms_reviews}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment','tourfirm_id','user_id'], 'required'],
            [['user_id', 'tourfirm_id', 'date_create','status'], 'integer'],
            [['comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'user_id' => 'User ID',
            'tourfirm_id' => 'Tourfirm ID',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TourfirmsReviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourfirmsReviewsQuery(get_called_class());
    }

    public function getUser(){
        return $this->hasOne(UserProfile::className(), ['user_id'=>'user_id']);
    }

    public function getComments() {
        return $this->hasMany(ReviewsComment::className(), ['reviews_id'=>'id']);
    }
}
