<?php
$this->breadcrumbs=array(
	'Talonarios'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Talonarios','url'=>array('index')),
	array('label'=>'Nuevo Talonarios','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>