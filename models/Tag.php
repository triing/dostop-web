<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property string $id
 *
 * @property Clearance[] $clearances
 * @property TagAssignment[] $tagAssignments
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClearances()
    {
        return $this->hasMany(Clearance::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagAssignments()
    {
        return $this->hasMany(TagAssignment::className(), ['tag_id' => 'id']);
    }
}
