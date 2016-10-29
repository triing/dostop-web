<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipality".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $country_code
 *
 * @property Country $countryCode
 * @property Organization[] $organizations
 */
class Municipality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'type'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['type'], 'string', 'max' => 1],
            [['country_code'], 'string', 'max' => 2],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'country_code' => Yii::t('app', 'Country Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCode()
    {
        return $this->hasOne(Country::className(), ['code' => 'country_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['municipality_id' => 'id']);
    }
	
	public static function getMunicipalitesbyCountry($country_code) {
		$data = static::find()->where(['country_code'=>$country_code])->select(["id", "name"])->asArray()->all();
		$value = (count($data) == 0) ? ['' => ''] : $data;

		return $value;
	}
	
}
