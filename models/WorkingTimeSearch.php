<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WorkingTime;

/**
 * WorkingTimeSearch represents the model behind the search form about `\app\models\WorkingTime`.
 */
class WorkingTimeSearch extends WorkingTime
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_management_id', 'building_management_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
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
        $query = WorkingTime::find();

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
            'room_management_id' => $this->room_management_id,
            'building_management_id' => $this->building_management_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
