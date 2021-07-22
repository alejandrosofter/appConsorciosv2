<?php
$this->breadcrumbs=array(
	'Talonarios'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Talonarios','url'=>array('index')),
);
?>

<h1>Nuevo Talonarios</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>