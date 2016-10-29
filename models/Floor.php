<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

use app\models\Building;

/**
 * This is the model class for table "floor".
 *
 * @property integer $id
 * @property integer $building_id
 * @property string $code
 * @property string $name
 * @property string $separator
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Building $building
 * @property User $createdBy
 * @property User $updatedBy
 * @property FloorLog[] $floorLogs
 */
class Floor extends \yii\db\ActiveRecord
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
        return 'floor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_id', 'code', 'name'], 'required'],
            [['building_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 32],
            [['separator'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'building_id' => Yii::t('app', 'Building'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'separator' => Yii::t('app', 'Separator'),
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
              $floor_log = new FloorLog;
              $floor_log->floor_id = $this->id;
              $floor_log->updated_by = $this->updated_by;
              $floor_log->created_at = time();
              $floor_log->save();
            } 
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(Building::className(), ['id' => 'building_id']);
    }

	public function getFullcode() {
		return $this->getBuilding()->one()->code . $this->getBuilding()->one()->separator . $this->code;
	}
	
	public function getCodebuildingandname() {
		return $this->getFullcode() . " " . $this->getBuilding()->one()->name . " - " . $this->name;
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFloorLogs()
    {
        return $this->hasMany(FloorLog::className(), ['floor_id' => 'id']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['floor_id' => 'id']);
    }
}
