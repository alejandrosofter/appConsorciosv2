<?php
$this->breadcrumbs=array(
	'Para Cobrar'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a ParaCobrar','url'=>array('index')),
	array('label'=>'Nuevo ParaCobrar','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>