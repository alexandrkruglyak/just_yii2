<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tbl_visa".
 *
 * @property integer $id
 * @property string $description
 * @property integer $country_id
 * @property integer $tour_id
 * @property integer $price
 * @property integer $date_create
 * @property integer $date_update
 * @property integer $city_id
 * @property string $documents
 * @property integer $registration_period
 * @property string $slug
 * @property integer $user_id
 * @property integer $type_one
 * @property integer $type_two
 */
class Visa extends \yii\db\ActiveRecord
{
    public $user_id;
    public $country_from_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_visa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'type_time', 'type', 'name', 'country_id', 'city_id', 'manager_id'], 'required'],
            [['country_id', 'tour_id', 'price', 'city_id', 'registration_period', 'tourfirm_id', 'manager_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['documents', 'slug'], 'string', 'max' => 200]
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => new Expression(time()),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'country_id' => 'Country ID',
            'tour_id' => 'Tour ID',
            'price' => 'Price',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'city_id' => 'City ID',
            'documents' => 'Documents',
            'registration_period' => 'Registration Period',
            'slug' => 'Slug',
            'user_id' => 'User ID',
            'type_one' => 'Type One',
            'type_two' => 'Type Two',
        ];
    }

    public function getPeriod(){
        return $this->registration_period;
    }

    public function getManagerPhon(){
        return $this->hasOne(ManagersPhone::className(), ['manager_id' =>'manager_id']);
    }

    public function getManager(){
        return $this->hasOne(User::className(), ['id' =>'manager_id']);
    }
}
