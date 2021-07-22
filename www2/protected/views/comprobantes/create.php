<?php
$this->breadcrumbs=array(
	'Comprobantes'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Comprobantes','url'=>array('index')),
);
?>

<h1>Nuevo Comprobante</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>