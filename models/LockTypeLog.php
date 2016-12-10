<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lock_type_log".
 *
 * @property integer $id
 * @property integer $lock_type_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property LockType $lockType
 * @property User $updatedBy
 */
class LockTypeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lock_type_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lock_type_id', 'updated_by', 'created_at'], 'required'],
            [['lock_type_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lock_type_id' => Yii::t('app', 'Lock Type ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLockType()
    {
        return $this->hasOne(LockType::className(), ['id' => 'lock_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
