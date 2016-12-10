<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag_assignment_log".
 *
 * @property integer $id
 * @property integer $tag_assignment_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property TagAssignment $tagAssignment
 * @property User $updatedBy
 */
class TagAssignmentLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_assignment_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_assignment_id', 'updated_by', 'created_at'], 'required'],
            [['tag_assignment_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag_assignment_id' => Yii::t('app', 'Tag Assignment ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagAssignment()
    {
        return $this->hasOne(TagAssignment::className(), ['id' => 'tag_assignment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
