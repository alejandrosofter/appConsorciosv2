<?php
$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Consultas','url'=>array('index')),
	array('label'=>'Nueva Consulta','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>