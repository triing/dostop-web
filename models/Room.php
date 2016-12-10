<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "room".
 *
 * @property integer $id
 * @property integer $floor_id
 * @property string $code
 * @property string $name
 * @property integer $xpos
 * @property integer $ypos
 * @property double $area
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property Floor $floor
 * @property User $updatedBy
 * @property RoomLog[] $roomLogs
 */
class Room extends \yii\db\ActiveRecord
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
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['floor_id', 'code', 'name'], 'required'],
            [['floor_id', 'xpos', 'ypos', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['area'], 'number'],
            [['code'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'floor_id' => Yii::t('app', 'Floor ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'xpos' => Yii::t('app', 'Xpos'),
            'ypos' => Yii::t('app', 'Ypos'),
            'area' => Yii::t('app', 'Area'),
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
              $room_log = new RoomLog;
              $room_log->room_id = $this->id;
              $room_log->updated_by = $this->updated_by;
              $room_log->created_at = time();
              $room_log->save();
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
    public function getFloor()
    {
        return $this->hasOne(Floor::className(), ['id' => 'floor_id']);
    }

	public function getFullcode() {
		return $this->getFloor()->one()->fullcode . $this->getFloor()->one()->separator . $this->code;
	}
	
	public function getCodename() {
		return $this->getFullcode() . " - " . $this->name;
	}
	
    public function getDoorsTo()
    {
        return $this->hasMany(Door::className(), ['to_room_id' => 'id']);
    }
    public function getDoorsFrom()
    {
        return $this->hasMany(Door::className(), ['from_room_id' => 'id']);
    }
    public function getManagements()
    {
        return $this->hasMany(RoomManagement::className(), ['room_id' => 'id']);
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
    public function getRoomLogs()
    {
        return $this->hasMany(RoomLog::className(), ['room_id' => 'id']);
    }
}
