<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "working_time_log".
 *
 * @property integer $id
 * @property integer $working_time_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property WorkingTime $workingTime
 * @property User $updatedBy
 */
class WorkingTimeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'working_time_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['working_time_id', 'updated_by', 'created_at'], 'required'],
            [['working_time_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'working_time_id' => Yii::t('app', 'Working Time ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkingTime()
    {
        return $this->hasOne(WorkingTime::className(), ['id' => 'working_time_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
