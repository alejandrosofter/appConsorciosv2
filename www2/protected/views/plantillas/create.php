<?php
$this->breadcrumbs=array(
	'Plantillas'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Plantillas','url'=>array('index')),
);
?>

<h1>Nueva Plantilla</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>