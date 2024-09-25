<?php

use app\models\TipoAccidente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Estatus;

/** @var yii\web\View $this */
/** @var app\models\TipoaccidenteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tipo de Accidente';
?>
<div class="tipo-accidente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Tipo de Accidente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'options' => ['class'=> 'pagination'],
            'firstPageCssClass' => 'page-item',
            'lastPageCssClass' => 'page-item', 
            'nextPageCssClass' => 'page-item',
            'prevPageCssClass' => 'page-item',
            'pageCssClass' => 'page-item',
            'disabledPageCssClass' => 'disabled d-none',
            'linkOptions' => ['style' => 'text-decoration: none;', 'class' => 'page-link'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'header' => 'Nº', //Para que no aparezca el # sino la letra que se requiera],
            'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'], // Cambia el tamaño de la columna
            ], 

            //'id_tipo_accidente',
            //'id_sub2_tipo_accid',
            //'id_sub_tipo_accid',
            //'id_tipo_accid1',
            //'id_tipo_accid',
            //'descripcion',
            [   
                'attribute' => 'descripcion',
                'label' => 'descripcion',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Busqueda',
                ],
            ],
            //'codigo',
            [   
                'attribute' => 'codigo',
                'label' => 'Codigo',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Busqueda',
                ],
            ],
            //'id_estatus',

       //Esto es Para que muestre el estatus en vez del id almacenado en la tabla regiones
       [   
        'attribute' => 'id_estatus',
        'value' => array($searchModel, 'buscarEstatus'),
        'filter' => 
        Html::activeDropDownList($searchModel, 'id_estatus',
        ArrayHelper::map(Estatus::find()->all(), 'id_estatus', 'descripcion'),
        ['prompt'=> 'Busqueda', 'class' => 'form-control']),
        'headerOptions' => ['class' => 'col-lg-03 text-center'],
        'contentOptions' => ['class' => 'col-lg-03 text-center'],

    ],


            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TipoAccidente $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_tipo_accidente' => $model->id_tipo_accidente]);
                 }
            ],
        ],
    ]); ?>


</div>
