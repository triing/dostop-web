<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clearance".
 *
 * @property integer $id
 * @property integer $door_id
 * @property string $tag_id
 * @property string $start_date
 * @property string $end_date
 *
 * @property Door $door
 * @property Tag $tag
 */
class Clearance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clearance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['door_id', 'tag_id'], 'required'],
            [['door_id'], 'integer'],
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
            'door_id' => Yii::t('app', 'Door ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoor()
    {
        return $this->hasOne(Door::className(), ['id' => 'door_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
