<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use DateTime;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja deletar este usuário?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
	    [ 
		'attribute' => 'id_curso',
		'value' => $model->curso->nome,
	    ],
            //'status',
            [
		'attribute' => 'created_at',
		'value' => (new DateTime())->setTimestamp($model->created_at)->format('d/m/Y'),
	    ]
            //'updated_at',
        ],
    ]) ?>

</div>
