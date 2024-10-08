<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\SujetoAfectacion $model */

$this->title = 'Crear Ambiente';

?>
<div class="sujeto-afectacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-ambiente', [
        'model' => $model,
    ]) ?>

  <!-- BOTON DE VOLVER-->
  <?= Html::button('Atrás', ['class' => 'my-custom-button', 'onclick' => 'location.href=\''.Url::toRoute(["ambiente"]).'\'']) ?>
    

</div>
