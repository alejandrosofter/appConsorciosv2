<?php
$this->breadcrumbs=array(
	'Liquidaciones Gastoses'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a LiquidacionesGastos','url'=>array('index')),
	array('label'=>'Nuevo LiquidacionesGastos','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>