<?php
$this->breadcrumbs=array(
	'Comprobantes'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Comprobantes','url'=>array('index')),
	array('label'=>'Nuevo Comprobantes','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>