<?php
$this->breadcrumbs=array(
	'Ubicaciones'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Ubicaciones','url'=>array('index')),
	array('label'=>'Nuevo Ubicaciones','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>