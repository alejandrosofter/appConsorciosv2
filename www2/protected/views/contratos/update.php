<?php
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Contratos','url'=>array('index')),
	array('label'=>'Nuevo Contratos','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'items'=>$items)); ?>