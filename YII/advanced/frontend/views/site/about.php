<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Sobre o jogo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <h3>Para movimentar:</h3>
    
    <p> Use seta para cima pra rotacionar </p>
    <p> Setas para direita e esquerda para mover </p>
    <p> Pressione espaço para pausar o jogo. </p>
            
    <h3>Pontuação: </h3>
    <p> 1 linha = 10 pontos </p>
    <p> 2 linhas = 30 pontos </p>
    <p> 3 linhas = 70 pontos </p>
    <p> 4 linhas = 150 pontos </p>

  <!--  <code><?= __FILE__ ?></code>-->
</div>
