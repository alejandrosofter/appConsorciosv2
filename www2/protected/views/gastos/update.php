<?php
$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Gastos','url'=>array('index')),
	array('label'=>'Nuevo Gasto','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'modelComprobante'=>$modelComprobante,'valores'=>$valores,'porcentajes'=>$porcentajes)); ?>