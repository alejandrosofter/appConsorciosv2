<?php
$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Entidades','url'=>array('index')),
	array('label'=>'Nuevo Entidades','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>