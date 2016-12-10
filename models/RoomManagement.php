<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "room_management".
 *
 * @property integer $id
 * @property integer $organization_id
 * @property integer $room_id
 * @property integer $management_type_id
 * @property integer $contract_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property Organization $organization
 * @property Room $room
 * @property ManagementType $managementType
 * @property User $updatedBy
 * @property RoomManagementLog[] $roomManagementLogs
 */
class RoomManagement extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
			[
			  'class' => BlameableBehavior::className(),
			  'createdByAttribute' => 'created_by',
			  'updatedByAttribute' => 'updated_by',
			],
			'timestamp' => [
				 'class' => 'yii\behaviors\TimestampBehavior',
				 'attributes' => [
					 ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					 ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
				 ],
			],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'room_id', 'management_type_id', 'start_date'], 'required'],
            [['organization_id', 'room_id', 'management_type_id', 'contract_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['start_date', 'end_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'organization_id' => Yii::t('app', 'Organization ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'management_type_id' => Yii::t('app', 'Management Type ID'),
            'contract_id' => Yii::t('app', 'Contract ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

	public function afterSave($insert,$changedAttributes)
    {
            parent::afterSave($insert,$changedAttributes);
            // when insert false, then record has been updated
            if (!$insert) {
              // add Log entry
              $room_management_log = new RoomManagementLog;
              $room_management_log->room_management_id = $this->id;
              $room_management_log->updated_by = $this->updated_by;
              $room_management_log->created_at = time();
              $room_management_log->save();
            } 
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomManagementLogs()
    {
        return $this->hasMany(RoomManagementLog::className(), ['room_management_id' => 'id']);
    }
}
