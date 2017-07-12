<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = 'Tetris';
?>

	<?php
   	   $this->registerCssFile('/css/estilos.css');
	?>
        <div id="tabuleiro"></div>
	<?php
            $this->registerJsFile('/js/tetris.js', ['position' => $this::POS_END]);
        ?>
        <div id="score"></div>
	
