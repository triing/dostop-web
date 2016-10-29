<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_type_log".
 *
 * @property integer $id
 * @property integer $role_type_id
 * @property integer $updated_by
 * @property integer $created_at
 *
 * @property RoleType $roleType
 * @property User $updatedBy
 */
class RoleTypeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_type_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_type_id', 'updated_by', 'created_at'], 'required'],
            [['role_type_id', 'updated_by', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role_type_id' => Yii::t('app', 'Role Type ID'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleType()
    {
        return $this->hasOne(RoleType::className(), ['id' => 'role_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
