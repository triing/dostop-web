<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partnership_type_log".
 *
 * @property integer $id
 * @property integer $partnership_type_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property PartnershipType $partnershipType
 * @property User $updatedBy
 */
class PartnershipTypeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partnership_type_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partnership_type_id', 'updated_by', 'created_at'], 'required'],
            [['partnership_type_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'partnership_type_id' => Yii::t('app', 'Partnership Type ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnershipType()
    {
        return $this->hasOne(PartnershipType::className(), ['id' => 'partnership_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
