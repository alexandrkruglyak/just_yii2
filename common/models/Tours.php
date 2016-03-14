<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "{{%tours}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $status
 * @property string $price
 * @property integer $country_to_id
 * @property integer $city_to_id
 * @property integer $city_from_id
 * @property string $date_from
 * @property integer $count_old
 * @property integer $count_kids
 * @property integer $hotel_id
 * @property integer $user_id
 * @property string $body
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $created_at
 * @property integer $published_at
 */
class Tours extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $thumbnail;
    public $country_from_id;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'published_at',
                'value' => new Expression(time()),
            ],
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'title',
                'immutable' => true
            ],

            /*[
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'articleAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]*/
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tours}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','price', 'country_to_id', 'city_to_id', 'city_from_id', 'date_from', 'count_old',  'body'], 'required'],
            [['country_to_id', 'city_to_id', 'city_from_id', 'count_old', 'count_kids', 'hotel_id', 'user_id','tourfirm_id', 'created_at', 'published_at','hot'], 'integer'],
            [['body'], 'string'],
            [['title', 'slug', 'status', 'price', 'date_from'], 'string', 'max' => 255],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['slug','status','user_id','thumbnail_base_url', 'thumbnail_path', 'created_at', 'published_at', 'count_kids','count_days','count_nights', 'transport_type'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hot' => 'Горящий тур',
            'title' => 'Название тура',
            'slug' => 'URL',
            'status' => 'Статус',
            'price' => 'Стоимость',
            'country_to_id' => 'Страна назначения',
            'city_to_id' => 'Город назначения',
            'city_from_id' => 'Город вылета',
            'date_from' => 'Дата вылета',
            'count_old' => 'Взрослых',
            'count_kids' => 'Детей',
            'hotel_id' => 'Отель',
            'user_id' => 'User ID',
            'body' => 'Описание',
            'thumbnail_base_url' => 'Основная картинка',
            'thumbnail_path' => 'Дополнительные изображения',
            'created_at' => 'Created At',
            'published_at' => 'Published At',
        ];
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(), ['country_id'=>'country_to_id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
    public function getTransport(){
        return $this->hasOne(Transports::className(), ['id'=>'transport_type']);
    }

    public function getContactManager(){
        return $this->hasOne(ManagersPhone::className(), ['manager_id'=>'user_id']);
    }

    public function getCity(){
        return $this->hasOne(Cities::className(), ['id'=>'city_to_id']);
    }

}
