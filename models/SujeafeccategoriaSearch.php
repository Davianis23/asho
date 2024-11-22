<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SujeAfecCategoria;

/**
 * SujeafeccategoriaSearch represents the model behind the search form of `app\models\SujeAfecCategoria`.
 */
class SujeafeccategoriaSearch extends SujeAfecCategoria
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'id_estatus'], 'integer'],
            [['name', 'complete_name', 'parent_path', 'codigo', 'created_at', 'updated_at'], 'safe'],
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

    //Query para buscar el estatus (activo, inactivo, etc).
    //Parametros: $data:$searchModel /  $id: id_estatus
    public function buscarEstatus($data, $id){
        $modelbuscar = Estatus::findOne($data->id_estatus);
        $content = $modelbuscar->descripcion;
        return $content;
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
        $query = SujeAfecCategoria::find();

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
            'parent_id' => $this->parent_id,
            'id_estatus' => $this->id_estatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id_estatus' => $this->id_estatus,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'complete_name', $this->complete_name])
            ->andFilterWhere(['ilike', 'parent_path', $this->parent_path])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo]);

        return $dataProvider;
    }
}