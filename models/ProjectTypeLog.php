<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_type_log".
 *
 * @property integer $id
 * @property integer $project_type_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property ProjectType $projectType
 * @property User $updatedBy
 */
class ProjectTypeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_type_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_type_id', 'updated_by', 'created_at'], 'required'],
            [['project_type_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_type_id' => Yii::t('app', 'Project Type ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectType()
    {
        return $this->hasOne(ProjectType::className(), ['id' => 'project_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
