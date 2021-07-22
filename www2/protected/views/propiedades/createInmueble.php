<?php
$this->breadcrumbs=array(
	'Inmuebles'=>array('indexInmuebles'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Inmuebles','url'=>array('index')),
);
?>

<h1>Nuevo Inmueble</h1>

<?php echo $this->renderPartial('_formInmueble', array('model'=>$model)); ?>