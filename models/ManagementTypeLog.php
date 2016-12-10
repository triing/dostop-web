<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "management_type_log".
 *
 * @property integer $id
 * @property integer $management_type_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property ManagementType $managementType
 * @property User $updatedBy
 */
class ManagementTypeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'management_type_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['management_type_id', 'updated_by', 'created_at'], 'required'],
            [['management_type_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'management_type_id' => Yii::t('app', 'Management Type ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagementType()
    {
        return $this->hasOne(ManagementType::className(), ['id' => 'management_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
