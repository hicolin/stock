<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AdminProduct;

/**
 * AdminProductSearch represents the model behind the search form about `backend\models\AdminProduct`.
 */
class AdminProductSearch extends AdminProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'do_time', 'in_time'], 'integer'],
            [['risk', 'label', 'single_income'], 'safe'],
            [['single_money', 'amoun_money'], 'number'],
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
        $query = AdminProduct::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'do_time' => $this->do_time,
            'in_time' => $this->in_time,
            'single_money' => $this->single_money,
            'amoun_money' => $this->amoun_money,
        ]);

        $query->andFilterWhere(['like', 'risk', $this->risk])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'single_income', $this->single_income]);

        return $dataProvider;
    }
}
