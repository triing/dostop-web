<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "partnership_type".
 *
 * @property integer $id
 * @property string $description_sl
 * @property string $description_en
 * @property integer $allow_edit_project
 * @property integer $allow_edit_partners
 * @property integer $allow_edit_products
 * @property integer $allow_edit_events
 * @property integer $allow_edit_participants
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property PartnershipTypeLog[] $partnershipTypeLogs
 */
class PartnershipType extends \yii\db\ActiveRecord
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
        return 'partnership_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description_sl', 'description_en'], 'required'],
            [['allow_edit_project', 'allow_edit_partners', 'allow_edit_products', 'allow_edit_events', 'allow_edit_participants', 'allow_edit_roles', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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
            'allow_edit_project' => Yii::t('app', 'Allow Edit Project'),
            'allow_edit_partners' => Yii::t('app', 'Allow Edit Partners'),
            'allow_edit_products' => Yii::t('app', 'Allow Edit Products'),
            'allow_edit_events' => Yii::t('app', 'Allow Edit Events'),
            'allow_edit_participants' => Yii::t('app', 'Allow Edit Participants'),
            'allow_edit_roles' => Yii::t('app', 'Allow Edit Roles'),
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
              $partnership_type_log = new PartnershipTypeLog;
              $partnership_type_log->partnership_type_id = $this->id;
              $partnership_type_log->updated_by = $this->updated_by;
              $partnership_type_log->created_at = time();
              $partnership_type_log->save();
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
    public function getPartnershipTypeLogs()
    {
        return $this->hasMany(PartnershipTypeLog::className(), ['partnership_type_id' => 'id']);
    }
}
