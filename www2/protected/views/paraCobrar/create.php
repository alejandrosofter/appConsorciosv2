<?php
$this->breadcrumbs=array(
	'Para Cobrar'=>array('index'),
	'Nueva Deuda',
);

$this->menu=array(
array('label'=>'Ir a Para Cobrar','url'=>array('index')),
);
?>

<h1>Nueva Deuda</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>