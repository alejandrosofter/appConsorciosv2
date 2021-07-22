<?php
$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Pagos','url'=>array('index')),
);
?>

<h1>Nuevo Pago</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>