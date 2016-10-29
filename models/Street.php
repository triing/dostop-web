<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "street".
 *
 * @property integer $id
 * @property integer $municipality_id
 * @property integer $settlement_id
 * @property string $name
 * @property string $country_code
 *
 * @property Organization[] $organizations
 * @property Country $countryCode
 * @property Municipality $municipality
 */
class Street extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'street';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'municipality_id', 'settlement_id', 'name'], 'required'],
            [['id', 'municipality_id', 'settlement_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
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
            'municipality_id' => Yii::t('app', 'Municipality ID'),
            'settlement_id' => Yii::t('app', 'Settlement ID'),
            'name' => Yii::t('app', 'Name'),
            'country_code' => Yii::t('app', 'Country Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['street_id' => 'id']);
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
    public function getMunicipality()
    {
        return $this->hasOne(Municipality::className(), ['id' => 'municipality_id']);
    }
	
	public static function getStreetsbyMunicipality($municipality_id) {
		$data = static::find()->where(['municipality_id'=>$municipality_id])->select(["id", "name"])->asArray()->all();
		$value = (count($data) == 0) ? ['' => ''] : $data;

		return $value;
	}
	
}
