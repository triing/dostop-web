<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "door".
 *
 * @property integer $id
 * @property integer $to_room_id
 * @property integer $from_room_id
 * @property integer $lock_type_id
 * @property string $secret
 * @property double $preference
 * @property integer $xpos
 * @property integer $ypos
 * @property string $direction
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property Room $fromRoom
 * @property LockType $lockType
 * @property Room $toRoom
 * @property User $updatedBy
 * @property DoorLog[] $doorLogs
 */
class Door extends \yii\db\ActiveRecord
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
        return 'door';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to_room_id', 'lock_type_id', 'secret'], 'required'],
            [['to_room_id', 'from_room_id', 'lock_type_id', 'xpos', 'ypos', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['preference'], 'number'],
            [['secret'], 'string', 'max' => 255],
            [['direction'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'to_room_id' => Yii::t('app', 'To Room ID'),
            'from_room_id' => Yii::t('app', 'From Room ID'),
            'lock_type_id' => Yii::t('app', 'Lock Type ID'),
            'secret' => Yii::t('app', 'Secret'),
            'preference' => Yii::t('app', 'Preference'),
            'xpos' => Yii::t('app', 'Xpos'),
            'ypos' => Yii::t('app', 'Ypos'),
            'direction' => Yii::t('app', 'Direction'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert)){
		   $this->secret = Yii::$app->security->generatePasswordHash($this->secret);
		   return true;
		}else{
		   return false;
		}
	}
	
	public function afterSave($insert,$changedAttributes)
    {
            parent::afterSave($insert,$changedAttributes);
            // when insert false, then record has been updated
            if (!$insert) {
              // add Log entry
              $door_log = new DoorLog;
              $door_log->door_id = $this->id;
              $door_log->updated_by = $this->updated_by;
              $door_log->created_at = time();
              $door_log->save();
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
    public function getFromRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'from_room_id']);
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
    public function getToRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'to_room_id']);
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
    public function getDoorLogs()
    {
        return $this->hasMany(DoorLog::className(), ['door_id' => 'id']);
    }
}
