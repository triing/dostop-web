<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "membership_type_log".
 *
 * @property integer $id
 * @property integer $membership_type_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property MembershipType $membershipType
 * @property User $updatedBy
 */
class MembershipTypeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_type_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['membership_type_id', 'updated_by', 'created_at'], 'required'],
            [['membership_type_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'membership_type_id' => Yii::t('app', 'Membership Type ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipType()
    {
        return $this->hasOne(MembershipType::className(), ['id' => 'membership_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
