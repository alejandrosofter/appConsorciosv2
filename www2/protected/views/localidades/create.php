<?php
$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Localidades','url'=>array('index')),
);
?>

<h1>Nueva Localidad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>