<?php
$this->breadcrumbs=array(
	'Liquidaciones'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Liquidaciones','url'=>array('index')),
);
?>

<h1>Nueva Liquidación</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>