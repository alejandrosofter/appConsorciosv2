<?php
$this->breadcrumbs=array(
	'Liquidaciones Gastoses'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a LiquidacionesGastos','url'=>array('index')),
);
?>

<h1>Nuevo LiquidacionesGastos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>