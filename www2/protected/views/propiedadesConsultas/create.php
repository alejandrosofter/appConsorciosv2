<?php
$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a PropiedadesConsultas','url'=>array('index')),
);
?>

<h1>Nueva Consulta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>