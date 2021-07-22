<?php
$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Localidades','url'=>array('index')),
	array('label'=>'Nuevo Localidades','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>