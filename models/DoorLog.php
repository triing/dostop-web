<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "door_log".
 *
 * @property integer $id
 * @property integer $door_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property Door $door
 * @property User $updatedBy
 */
class DoorLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'door_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['door_id', 'updated_by', 'created_at'], 'required'],
            [['door_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'door_id' => Yii::t('app', 'Door ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoor()
    {
        return $this->hasOne(Door::className(), ['id' => 'door_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
