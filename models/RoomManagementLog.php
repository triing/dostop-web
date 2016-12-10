<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_management_log".
 *
 * @property integer $id
 * @property integer $room_management_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property RoomManagement $roomManagement
 * @property User $updatedBy
 */
class RoomManagementLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_management_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_management_id', 'updated_by', 'created_at'], 'required'],
            [['room_management_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'room_management_id' => Yii::t('app', 'Room Management ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomManagement()
    {
        return $this->hasOne(RoomManagement::className(), ['id' => 'room_management_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
