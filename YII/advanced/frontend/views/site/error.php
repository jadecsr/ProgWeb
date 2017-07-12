<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
       O erro acima ocorreu enquanto o Servidor processava seu pedido. Tente novamente.
    </p>
    <p>
        Entre em contato se você acredita que este erro é no servidor. Obrigada.
    </p>

</div>
