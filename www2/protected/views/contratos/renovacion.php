<?php
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Renovar',
);

$this->menu=array(
array('label'=>'Ir a Contratos','url'=>array('index')),
);
?>

<h1>Nueva Renovacion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'items'=>$items)); ?>