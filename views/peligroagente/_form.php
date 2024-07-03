<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PeligroAgente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="peligro-agente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_sub2_clas_pel')->textInput() ?>

    <?= $form->field($model, 'id_sub_cla_pel')->textInput() ?>

    <?= $form->field($model, 'id_cla_pel')->textInput() ?>

    <?= $form->field($model, 'id_peligro')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'codigo')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'id_estatus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
