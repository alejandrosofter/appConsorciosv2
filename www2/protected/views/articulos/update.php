<?php
$this->breadcrumbs=array(
	'Articuloses'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Articulos','url'=>array('index')),
	array('label'=>'Nuevo Articulos','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>