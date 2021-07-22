<?php
$this->breadcrumbs=array(
	'Contratos Cuotases'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a ContratosCuotas','url'=>array('index')),
);
?>

<h1>Nuevo ContratosCuotas</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>