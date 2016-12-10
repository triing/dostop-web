<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "management_type".
 *
 * @property integer $id
 * @property string $description_sl
 * @property string $description_en
 * @property integer $access_always
 * @property integer $access_working_hours
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property ManagementTypeLog[] $managementTypeLogs
 */
class ManagementType extends \yii\db\ActiveRecord
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
        return 'management_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description_sl', 'description_en'], 'required'],
            [['access_always', 'access_working_hours', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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
            'access_always' => Yii::t('app', 'Access Always'),
            'access_working_hours' => Yii::t('app', 'Access Working Hours'),
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
              $management_type_log = new ManagementTypeLog;
              $management_type_log->management_type_id = $this->id;
              $management_type_log->updated_by = $this->updated_by;
              $management_type_log->created_at = time();
              $management_type_log->save();
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
    public function getManagementTypeLogs()
    {
        return $this->hasMany(ManagementTypeLog::className(), ['management_type_id' => 'id']);
    }
}
