<?php
$this->breadcrumbs=array(
	'Gastos Frecuentes'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a EdificiosGastosFrecuentes','url'=>array('index')),
);
?>

<h1>Nuevo Gasto Frecuente</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'valores'=>$valores,'porcentajes'=>$porcentajes,"idEdificio"=>$idEdificio)); ?>