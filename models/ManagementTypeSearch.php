<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ManagementType;

/**
 * ManagementTypeSearch represents the model behind the search form about `\app\models\ManagementType`.
 */
class ManagementTypeSearch extends ManagementType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'access_always', 'access_working_hours', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['description_sl', 'description_en'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ManagementType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'access_always' => $this->access_always,
            'access_working_hours' => $this->access_working_hours,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description_sl', $this->description_sl])
            ->andFilterWhere(['like', 'description_en', $this->description_en]);

        return $dataProvider;
    }
}
