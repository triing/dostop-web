<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MembershipType;

/**
 * MembershipTypeSearch represents the model behind the search form about `\app\models\MembershipType`.
 */
class MembershipTypeSearch extends MembershipType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'allow_edit_organization', 'allow_edit_projects', 'allow_edit_members', 'allow_edit_rooms', 'allow_edit_resources', 'allow_edit_products', 'allow_edit_events', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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
        $query = MembershipType::find();

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
            'allow_edit_organization' => $this->allow_edit_organization,
            'allow_edit_projects' => $this->allow_edit_projects,
            'allow_edit_members' => $this->allow_edit_members,
            'allow_edit_rooms' => $this->allow_edit_rooms,
            'allow_edit_resources' => $this->allow_edit_resources,
            'allow_edit_products' => $this->allow_edit_products,
            'allow_edit_events' => $this->allow_edit_events,
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
