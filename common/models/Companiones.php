<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_companiones".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $age_with
 * @property integer $age_to
 * @property integer $type_travel_id
 * @property string $purpose_travel
 * @property string $about_me
 * @property string $about_traveler
 * @property string $travel_location
 */
class Companiones extends \yii\db\ActiveRecord
{
    public $qwer;
    public $interes;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_companiones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'age_with', 'age_to', 'type_travel_id'], 'integer'],
            [['purpose_travel', 'about_me', 'about_traveler', 'travel_location', 'gender_traveler'], 'string', 'max' => 200],
            [['purpose_travel', 'about_me', 'about_traveler', 'travel_location'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'age_with' => 'Age With',
            'age_to' => 'Age To',
            'type_travel_id' => 'Type Travel ID',
            'purpose_travel' => 'Purpose Travel',
            'about_me' => 'About Me',
            'about_traveler' => 'About Traveler',
            'travel_location' => 'Travel Location',
            'iterests' => 'Interests',
            'gender_traveler' => 'Gender Traveler',
        ];
    }

    public function getGender(){
        return $this->hasOne(CompanionesGender::className(), ['id' => 'gender_traveler']);
    }

    public function getMyCompaniones()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert && yii::$app->request->post()) {
            $model = new CompanionesCompany();
            $model->man = yii::$app->request->post('CompanionesCompany')['man'];
            $model->woman = yii::$app->request->post('CompanionesCompany')['woman'];
            $model->company = yii::$app->request->post('CompanionesCompany')['company'];
            $model->companion_id = yii::$app->db->lastInsertID;
            $comInterests = new CompanionesInterests();
            $comInterests->interests = yii::$app->request->post('Companiones')['interes'];
            $comInterests->companion_id = yii::$app->db->lastInsertID;
            $comInterests->save();
            $model->save();
        }
    }

    public static function updateCompanionesCompany($id, $post)
    {
        if ($id) {
            $model = new CompanionesCompany();
            $model->updateAll(
                [
                    'man' => $post['man'],
                    'woman' => $post['woman'],
                    'company' => $post['company'],
                ],
                ['companion_id' => $id]
            );
        }


    }
}
