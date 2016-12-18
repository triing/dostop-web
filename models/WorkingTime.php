<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
// use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "working_time".
 *
 * @property integer $id
 * @property integer $room_management_id
 * @property integer $building_management_id
 * @property string $start_time
 * @property string $end_time
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property RoomManagement $roomManagement
 * @property User $updatedBy
 * @property WorkingTimeLog[] $workingTimeLogs
 */
class WorkingTime extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
//			[
//			  'class' => BlameableBehavior::className(),
//			  'createdByAttribute' => 'created_by',
//			  'updatedByAttribute' => 'updated_by',
//			],
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
        return 'working_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_management_id', 'building_management_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['start_time', 'end_time'], 'required'],
            [['start_time', 'end_time'], 'safe']
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
            'building_management_id' => Yii::t('app', 'Building Management ID'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
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
              $working_time_log = new WorkingTimeLog;
              $working_time_log->working_time_id = $this->id;
              $working_time_log->updated_by = $this->updated_by;
              $working_time_log->created_at = time();
              $working_time_log->save();
            }
    }
	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			// deletes log records
			Yii::$app->db->createCommand()->delete('working_time_log', ['working_time_id' => $this->id])->execute();
			return true;
		} else {
			return false;
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkingTimeLogs()
    {
        return $this->hasMany(WorkingTimeLog::className(), ['working_time_id' => 'id']);
    }
}
