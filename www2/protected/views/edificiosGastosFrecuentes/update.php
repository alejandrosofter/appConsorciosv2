<?php
$this->breadcrumbs=array(
	'Gastos Frecuentes'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Gastos Frecuentes','url'=>array('index')),
	array('label'=>'Nuevo Gastos Frecuentes','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'valores'=>$valores,'porcentajes'=>$porcentajes,"idEdificio"=>$idEdificio)); ?>