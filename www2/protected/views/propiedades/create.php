<?php
$this->breadcrumbs=array(
	'Propiedades'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Propiedades','url'=>array('index')),
);
?>

<h1>Nueva Propiedad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'idInquilino'=>$idInquilino,'idPropietario'=>$idPropietario)); ?>