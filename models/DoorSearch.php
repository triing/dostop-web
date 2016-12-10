<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Door;

/**
 * DoorSearch represents the model behind the search form about `\app\models\Door`.
 */
class DoorSearch extends Door
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'to_room_id', 'from_room_id', 'lock_type_id', 'xpos', 'ypos', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['secret', 'direction'], 'safe'],
            [['preference'], 'number'],
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
        $query = Door::find();

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
            'to_room_id' => $this->to_room_id,
            'from_room_id' => $this->from_room_id,
            'lock_type_id' => $this->lock_type_id,
            'preference' => $this->preference,
            'xpos' => $this->xpos,
            'ypos' => $this->ypos,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'direction', $this->direction]);

        return $dataProvider;
    }
}
