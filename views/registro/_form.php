<?php

use app\models\Regiones;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Estados;

/** @var yii\web\View $this */
/** @var app\models\Registro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <?php
    // Obtener la cédula del usuario logeado
    $user = Yii::$app->user->identity;
    $cedulaReporta = $user->ci;

    // Asignar la cédula al modelo
    $model->cedula_reporta = $cedulaReporta;
    ?>

    <?= $form->field($model, 'cedula_reporta')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'nro_accidente')->textInput() ?>

    <?= $form->field($model, 'id_region')->dropDownList(
    ArrayHelper::map(Regiones::find()->all(),'id_regiones','descripcion'),
    ['prompt'=> 'Seleccionar región']);?>

    <?= $form->field($model, 'id_estado')->dropDownList(
    ArrayHelper::map(Estados::find()->all(),'id_estado','descripcion'),
    ['prompt'=> 'Seleccionar estado']);?>

    <?= $form->field($model, 'fecha_hora')->textInput() ?>
    </div>

    <?= $form->field($model, 'lugar')->textInput() ?>

    <?= $form->field($model, 'cedula_supervisor_60min')->textInput() ?>

    <?= $form->field($model, 'observaciones_60min')->textInput() ?>

    <?= $form->field($model, 'autorizado_60m')->checkbox() ?>

    <?= $form->field($model, 'id_estatus_proceso')->textInput() ?>

    <?= $form->field($model, 'acciones_tomadas_60min')->textInput() ?>

    <?= $form->field($model, 'cedula_pers_accide')->textInput() ?>

    <?= $form->field($model, 'cedula_validad_60min')->textInput() ?>

    <?= $form->field($model, 'id_magnitud')->textInput() ?>

    <?= $form->field($model, 'id_tipo_accidente')->textInput() ?>

    <?= $form->field($model, 'id_tipo_trabajo')->textInput() ?>

    <?= $form->field($model, 'id_peligro_agente')->textInput() ?>

    <?= $form->field($model, 'id_sujeto_afectacion')->textInput() ?>

    <?= $form->field($model, 'id_afecta_bienes_perso')->textInput() ?>

    <?= $form->field($model, 'cedula_24horas')->textInput() ?>

    <?= $form->field($model, 'acciones_tomadas_24horas')->textInput() ?>

    <?= $form->field($model, 'observaciones_24horas')->textInput() ?>

    <?= $form->field($model, 'recomendaciones_24horas')->textInput() ?>

    <?= $form->field($model, 'autorizado_24horas')->checkbox() ?>

    <?= $form->field($model, 'cedula_valid_24horas')->textInput() ?>

    <?= $form->field($model, 'descripcion_accidente_60min')->textInput() ?>

    <?= $form->field($model, 'id_gerencia')->textInput() ?>

    <?= $form->field($model, 'recomendaciones_60m')->textInput() ?>

    <?= $form->field($model, 'anno')->textInput() ?>

    <?= $form->field($model, 'correlativo')->textInput() ?>

    <?= $form->field($model, 'id_naturaliza_incidente')->textInput() ?>

    <?= $form->field($model, 'ocurrencia_hecho_60m')->textInput() ?>

    <?= $form->field($model, 'acciones_tomadas_24h')->textInput() ?>

    <?= $form->field($model, 'observaciones_24h')->textInput() ?>

    <?= $form->field($model, 'validado_por_24h')->textInput() ?>

    <?= $form->field($model, 'id_requerimiento_trabajo_24h')->textInput() ?>

    <?= $form->field($model, 'cumple_regla_oro')->checkbox() ?>

    <?= $form->field($model, 'id_afec_per_categoria')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
