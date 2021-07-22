<?php
$this->breadcrumbs=array(
	'Ubicaciones'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Ubicaciones','url'=>array('index')),
);
?>

<h1>Nuevo Ubicaciones</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>