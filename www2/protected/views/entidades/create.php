<?php
$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Entidades','url'=>array('index')),
);
?>

<h1>Nueva Entidad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>