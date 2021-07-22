<?php
$this->breadcrumbs=array(
	'Propiedades'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a Propiedades','url'=>array('index')),
	array('label'=>'Nuevo Propiedades','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'idInquilino'=>$idInquilino,'idPropietario'=>$idPropietario)); ?>