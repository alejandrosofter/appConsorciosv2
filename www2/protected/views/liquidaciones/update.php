<?php
$this->breadcrumbs=array(
	'Liquidaciones'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Liquidaciones','url'=>array('index')),
	array('label'=>'Nuevo Liquidaciones','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>