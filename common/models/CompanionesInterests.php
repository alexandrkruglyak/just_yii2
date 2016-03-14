<?php

namespace common\models;

use common\models\query\CompanionesCompanyQuery;
use Yii;

/**
 * This is the model class for table "{{%companiones_interests}}".
 *
 * @property integer $id
 * @property string $interests
 * @property integer $companion_id
 *
 * @property Companiones $companion
 */
class CompanionesInterests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%companiones_interests}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companion_id'], 'integer'],
            [['interests'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'interests' => 'Interests',
            'companion_id' => 'Companion ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanion()
    {
        return $this->hasOne(Companiones::className(), ['id' => 'companion_id']);
    }

    /**
     * @inheritdoc
     * @return CompanionesInterestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanionesCompanyQuery(get_called_class());
    }
}
