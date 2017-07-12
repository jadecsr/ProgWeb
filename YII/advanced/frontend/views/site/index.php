<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Tetris';
?>
<div class="site-index">

    <div class="jumbotron">
        <?= Html::img('@web/img/icomp.png',['width' => '520']) ?>
	<!--<?= Html::a('Home',['site/index'])?>-->

        <p><?= Html::a('Iniciar Jogo!', ['jogada/play'], ['class' => 'btn btn-success']) ?></p>
    </div>

    <div class="body-content">

        <div class="row">
        </div>

    </div>
</div>
