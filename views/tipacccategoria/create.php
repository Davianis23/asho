<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\TipAccCategoria $model */

$this->title = 'Crear Tipo de Accidente Categoria';


?>
<div class="tip-acc-categoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

     <!-- BOTON DE VOLVER-->
     <?= Html::button('Atrás', ['class' => 'my-custom-button', 'onclick' => 'location.href=\''.Url::toRoute(["index"]).'\'']) ?>

</div>
