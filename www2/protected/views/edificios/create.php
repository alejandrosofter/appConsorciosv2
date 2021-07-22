<?php
$this->breadcrumbs=array(
	'Edificios'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Edificios','url'=>array('index')),
);
?>

<h1>Nuevo Edificios</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>