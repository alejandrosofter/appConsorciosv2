<?php
$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Gastos','url'=>array('index')),
);
?>

<h1>Nuevo Gasto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelComprobante'=>$modelComprobante,'valores'=>$valores,'porcentajes'=>$porcentajes)); ?>