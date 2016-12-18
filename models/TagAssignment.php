<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tag_assignment".
 *
 * @property integer $id
 * @property string $tag_id
 * @property integer $person_id
 * @property integer $tag_type_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property Person $person
 * @property TagType $tagType
 * @property User $updatedBy
 * @property TagAssignmentLog[] $tagAssignmentLogs
 */
class TagAssignment extends \yii\db\ActiveRecord
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
        return 'tag_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'person_id', 'tag_type_id', 'start_date'], 'required'],
            [['person_id', 'tag_type_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['tag_id'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'person_id' => Yii::t('app', 'Person ID'),
            'tag_type_id' => Yii::t('app', 'Tag Type ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
		
			// Adds tag if not exists
			if(!Tag::find()->where(['id' => $this->tag_id])->exists()) {
				$tag = new Tag();
				$tag->id = $this->tag_id;
				$tag->save();
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function afterSave($insert,$changedAttributes)
    {
            parent::afterSave($insert,$changedAttributes);
			
			// Update clearances
			$this->updateClearances();
			
            // when insert false, then record has been updated
            if (!$insert) {
              // add Log entry
              $tag_assignment_log = new TagAssignmentLog;
              $tag_assignment_log->tag_assignment_id = $this->id;
              $tag_assignment_log->updated_by = $this->updated_by;
              $tag_assignment_log->created_at = time();
              $tag_assignment_log->save();
            } 
    }
	
	public function isValid() {
	
		if($this->end_date === NULL || DateTime($this->end_date) > DateTime()) {
			return true;
		}
		else {
			return false;
		}
	
	}
	
	public function updateClearances() {
	
		// Remove any clearances for current tag_id
		Clearance::deleteAll(['tag_id' => $this->tag_id]);
		
		// Find all memberships for the person
		foreach($this->getPerson()->one()->getMemberships()->each() as $membership) {
		
			// Only if membership is valid and type allows full time entrance
			if($membership->isValid() && $membership->getMembershipType()->one()->access_rooms_always) {
		
				// Find all rooms managed by organization
				foreach($membership->getOrganization()->one()->getRoomManagements()->each() as $room_management) {
				
					// Only if management is valid and type allows full time entrance
					if($room_management->isValid() && $room_management->getManagementType()->one()->access_always) {
					
						// Make clearances for all doors to the room
						foreach($room_management->getRoom()->one()->getDoorsTo()->each() as $door) {
						
							$clearance = new Clearance();
							$clearance->door_id = $door->id;
							$clearance->tag_id = $this->tag_id;
							$clearance->start_date = max($room_management->start_date, $membership->valid_from, $this->start_date);
							$clearance->end_date =  min($room_management->end_date, $membership->valid_to, $this->end_date);
							$clearance->save();
						}
					}
				}
			}
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
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagType()
    {
        return $this->hasOne(TagType::className(), ['id' => 'tag_type_id']);
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
    public function getTagAssignmentLogs()
    {
        return $this->hasMany(TagAssignmentLog::className(), ['tag_assignment_id' => 'id']);
    }
}
