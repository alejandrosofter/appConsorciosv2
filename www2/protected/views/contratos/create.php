<?php
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Contratos','url'=>array('index')),
);
?>

<h1>Nuevo Contrato</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'items'=>$items)); ?>