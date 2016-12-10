<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag_type_log".
 *
 * @property integer $id
 * @property integer $tag_type_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property TagType $tagType
 * @property User $updatedBy
 */
class TagTypeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_type_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_type_id', 'updated_by', 'created_at'], 'required'],
            [['tag_type_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag_type_id' => Yii::t('app', 'Tag Type ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
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
}
