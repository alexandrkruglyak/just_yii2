<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%countries}}".
 *
 * @property integer $country_id
 * @property string $name
 * @property string $currency_code
 * @property string $currency
 */
class Countries extends \yii\db\ActiveRecord
{

    public $searchCountries;
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'name', 'currency_code'], 'required'],
            [['country_id'], 'integer'],
            [['name', 'currency'], 'string', 'max' => 255],
            [['currency_code'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'name' => 'Name',
            'currency_code' => 'Currency Code',
            'currency' => 'Currency',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\CountriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CountriesQuery(get_called_class());
    }

    public static function getCountry($id){
        $data = Countries::find()->where(['country_id'=>$id])->one();
        return $data->name;
    }
}
