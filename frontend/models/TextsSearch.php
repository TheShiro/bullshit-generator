<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Texts;
use yii\db\Expression;

/**
 * TextsSearch represents the model behind the search form of `frontend\models\Texts`.
 */
class TextsSearch extends Texts
{

    public $count_sentence;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['text'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Texts::find();

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
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

    /**
     * @param $count - количество предложений
     */
    public function generator($count = 2)
    {
        if(!$count) {
            return '';
        }
        
        $this->count_sentence = $count;

        $search = Texts::find()
            ->orderBy(new Expression('rand()'))
            ->limit($count + 1)
            ->all();

        $array_sentence = [];
        foreach ($search as $val) {
            $array_sentence = array_merge($array_sentence, explode(".", trim($val->text, '.')));
        }

        shuffle($array_sentence);
        $array_sentence = array_slice($array_sentence, 0, $count);

        return implode('. ', $array_sentence) . '.';
    }
}
