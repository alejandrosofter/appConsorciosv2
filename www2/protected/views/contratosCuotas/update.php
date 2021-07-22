<?php
$this->breadcrumbs=array(
	'Contratos Cuotases'=>array('index'),
	'Actualizar',
);

	$this->menu=array(
	array('label'=>'Ir a ContratosCuotas','url'=>array('index')),
	array('label'=>'Nuevo ContratosCuotas','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>