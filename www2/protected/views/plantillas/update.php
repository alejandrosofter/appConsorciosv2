<?php
$this->breadcrumbs=array(
	'Plantillas'=>array('index'),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Plantillas','url'=>array('index')),
	array('label'=>'Nueva Plantillas','url'=>array('create')),
);
?>

<h1>Modificar Plantilla <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>