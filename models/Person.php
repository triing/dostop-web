<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $language
 * @property string $first_name
 * @property string $last_name
 * @property integer $user_id
 * @property string $birth_date
 * @property string $sex
 * @property integer $status_id
 * @property string $email
 * @property string $phone
 * @property integer $municipality_id
 * @property integer $postal_code
 * @property integer $street_id
 * @property string $house_no
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $user
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

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
    public function rules()
    {
        return [
            [['language', 'first_name', 'last_name'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'status_id', 'municipality_id', 'postal_code', 'street_id', 'exact_birth_date'], 'integer'],
            [['birth_date'], 'safe'],
            [['language'], 'string', 'max' => 2],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 32],
            [['sex'], 'string', 'max' => 1],
            [['phone'], 'string', 'max' => 16],
            [['house_no'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'language' => Yii::t('app', 'Language'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
//            'user_id' => Yii::t('app', 'User ID'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'sex' => Yii::t('app', 'Sex'),
            'status_id' => Yii::t('app', 'Status ID'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'municipality_id' => Yii::t('app', 'Municipality ID'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'street_id' => Yii::t('app', 'Street ID'),
            'house_no' => Yii::t('app', 'House No'),
            'exact_birth_date' => Yii::t('app', 'Exact Birth Date'),
        ];
    }

	public function afterSave($insert,$changedAttributes)
    {
            parent::afterSave($insert,$changedAttributes);
            // when insert false, then record has been updated
            if (!$insert) {
              // add Log entry
              $person_log = new PersonLog;
              $person_log->person_id = $this->id;
              $person_log->updated_by = $this->updated_by;
              $person_log->created_at = time();
              $person_log->save();
            } 
    }
	
	public function updateClearances() {
	
		// Update clearances for all (also invalid) tag assignments
		foreach($this->getTagAssignments()->each() as $tag_assignment) {
			$tag_assignment->updateClearances();
		}
	}
	
	public function getFirstnamelastnameemail() {
		return $this->first_name . " " . $this->last_name . " (" . $this->email . ")";
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
    public function getTagAssignments()
    {
        return $this->hasMany(TagAssignment::className(), ['person_id' => 'id']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberships()
    {
        return $this->hasMany(Membership::className(), ['person_id' => 'id']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getUser()
//    {
//        return $this->hasOne(User::className(), ['id' => 'user_id']);
//    }
}
