<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $name
 * @property string $domain
 * @property string $description
 * @property string $language
 * @property integer $organization_type_id
 * @property string $full_name
 * @property string $email
 * @property string $webpage
 * @property string $phone
 * @property string $country_code
 * @property integer $municipality_id
 * @property integer $postal_code
 * @property integer $street_id
 * @property string $house_no
 * @property string $activity_type_id
 * @property integer $registration_number
 * @property integer $tax_id
 * @property integer $promoted
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Organization extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
				'ensureUnique' => true,
				'value' => function ($event) {
					return $this->slug;
				}
			],
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
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'name', 'domain', 'language'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'organization_type_id', 'municipality_id', 'postal_code', 'street_id', 'registration_number', 'tax_id', 'promoted'], 'integer'],
            [['description'], 'string'],
            [['slug', 'phone'], 'string', 'max' => 16],
            [['name', 'full_name'], 'string', 'max' => 64],
            [['domain', 'email', 'webpage'], 'string', 'max' => 32],
            [['language', 'country_code'], 'string', 'max' => 2],
            [['house_no', 'activity_type_id'], 'string', 'max' => 8],
            [['slug'], 'unique'],
            [['name'], 'unique'],
            [['domain'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'name' => Yii::t('app', 'Name'),
            'domain' => Yii::t('app', 'Domain'),
            'description' => Yii::t('app', 'Description'),
            'language' => Yii::t('app', 'Language'),
            'organization_type_id' => Yii::t('app', 'Organization Type ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'email' => Yii::t('app', 'Email'),
            'webpage' => Yii::t('app', 'Webpage'),
            'phone' => Yii::t('app', 'Phone'),
            'country_code' => Yii::t('app', 'Country Code'),
            'municipality_id' => Yii::t('app', 'Municipality ID'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'street_id' => Yii::t('app', 'Street ID'),
            'house_no' => Yii::t('app', 'House No'),
            'activity_type_id' => Yii::t('app', 'Activity Type ID'),
            'registration_number' => Yii::t('app', 'Registration Number'),
            'tax_id' => Yii::t('app', 'Tax ID'),
            'promoted' => Yii::t('app', 'Promoted'),
        ];
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
}
