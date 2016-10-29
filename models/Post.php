<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $code
 * @property string $name
 * @property string $country_code
 *
 * @property Organization[] $organizations
 * @property Country $countryCode
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['country_code'], 'string', 'max' => 2],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'country_code' => Yii::t('app', 'Country Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['postal_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCode()
    {
        return $this->hasOne(Country::className(), ['code' => 'country_code']);
    }

	public static function getPostalCodesbyCountry($country_code) {
		$data = static::find()->where(['country_code'=>$country_code])->select(["code AS id", "CONCAT(code, ' ', name) AS name"])->asArray()->all();
		$value = (count($data) == 0) ? ['' => ''] : $data;

		return $value;
	}
	
	public function getpostalCodeName()
    {
        return $this->code.' '.$this->name;
    }
}
