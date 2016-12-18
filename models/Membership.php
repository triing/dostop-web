<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "membership".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $organization_id
 * @property integer $membership_type_id
 * @property string $valid_from
 * @property string $valid_to
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property Organization $organization
 * @property Person $person
 * @property MembershipType $membershipType
 * @property User $updatedBy
 * @property MembershipLog[] $membershipLogs
 */
class Membership extends \yii\db\ActiveRecord
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
        return 'membership';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'organization_id', 'membership_type_id', 'valid_from'], 'required'],
            [['person_id', 'organization_id', 'membership_type_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['valid_from', 'valid_to'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'person_id' => Yii::t('app', 'Person ID'),
            'organization_id' => Yii::t('app', 'Organization ID'),
            'membership_type_id' => Yii::t('app', 'Membership Type ID'),
            'valid_from' => Yii::t('app', 'Valid From'),
            'valid_to' => Yii::t('app', 'Valid To'),
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
              $role_type_log = new RoleTypeLog;
              $role_type_log->role_type_id = $this->id;
              $role_type_log->updated_by = $this->updated_by;
              $role_type_log->created_at = time();
              $role_type_log->save();
            }
			// Update user clearances
			$this->getUser()->one()->updateClearances();
    }
	
	public function isValid() {
	
		if(DateTime($this->valid_from) < DateTime() && ($this->valid_to === NULL || DateTime($this->valid_to) > DateTime())) {
			return true;
		}
		else {
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
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
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
    public function getMembershipType()
    {
        return $this->hasOne(MembershipType::className(), ['id' => 'membership_type_id']);
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
    public function getMembershipLogs()
    {
        return $this->hasMany(MembershipLog::className(), ['membership_id' => 'id']);
    }
}
