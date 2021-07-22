<?php
$this->breadcrumbs=array(
	'Inmuebles'=>array('indexInmuebles'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Inmuebles','url'=>array('index')),
	array('label'=>'Nuevo Inmueble','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_formInmueble',array('model'=>$model,'model'=>$model)); ?>