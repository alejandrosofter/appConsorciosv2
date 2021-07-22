<?php
$this->breadcrumbs=array(
	'Edificios'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Edificios','url'=>array('index')),
	array('label'=>'Nuevo Edificios','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>