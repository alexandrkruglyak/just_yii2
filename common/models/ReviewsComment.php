<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%reviewsComment}}".
 *
 * @property integer $id
 * @property integer $reviews_id
 * @property integer $comment
 * @property integer $uer_id
 * @property integer $date_create
 *
 * @property TourfirmsReviews $reviews
 */
class ReviewsComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reviewsComment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reviews_id', 'comment', 'user_id', 'date_create'], 'required'],
            [['reviews_id', 'user_id', 'date_create'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reviews_id' => 'Reviews ID',
            'comment' => 'Comment',
            'user_id' => 'Uer ID',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasOne(TourfirmsReviews::className(), ['id' => 'reviews_id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ReviewsCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ReviewsCommentQuery(get_called_class());
    }
}
