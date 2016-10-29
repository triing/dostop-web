<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "membership_type".
 *
 * @property integer $id
 * @property string $description_sl
 * @property string $description_en
 * @property integer $allow_edit_organization
 * @property integer $allow_edit_projects
 * @property integer $allow_edit_members
 * @property integer $allow_edit_rooms
 * @property integer $allow_edit_resources
 * @property integer $allow_edit_products
 * @property integer $allow_edit_events
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property MembershipTypeLog[] $membershipTypeLogs
 */
class MembershipType extends \yii\db\ActiveRecord
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
        return 'membership_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description_sl', 'description_en'], 'required'],
            [['allow_edit_organization', 'allow_edit_projects', 'allow_edit_members', 'allow_edit_rooms', 'allow_edit_resources', 'allow_edit_products', 'allow_edit_events', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['description_sl', 'description_en'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description_sl' => Yii::t('app', 'Description Sl'),
            'description_en' => Yii::t('app', 'Description En'),
            'allow_edit_organization' => Yii::t('app', 'Allow Edit Organization'),
            'allow_edit_projects' => Yii::t('app', 'Allow Edit Projects'),
            'allow_edit_members' => Yii::t('app', 'Allow Edit Members'),
            'allow_edit_rooms' => Yii::t('app', 'Allow Edit Rooms'),
            'allow_edit_resources' => Yii::t('app', 'Allow Edit Resources'),
            'allow_edit_products' => Yii::t('app', 'Allow Edit Products'),
            'allow_edit_events' => Yii::t('app', 'Allow Edit Events'),
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
              $membership_type_log = new MembershipTypeLog;
              $membership_type_log->membership_type_id = $this->id;
              $membership_type_log->updated_by = $this->updated_by;
              $membership_type_log->created_at = time();
              $membership_type_log->save();
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipTypeLogs()
    {
        return $this->hasMany(MembershipTypeLog::className(), ['membership_type_id' => 'id']);
    }
}
