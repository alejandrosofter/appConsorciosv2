<?php
$this->breadcrumbs=array(
	'Articulos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
array('label'=>'Ir a Articulos','url'=>array('index')),
);
?>

<h1>Nuevo Articulo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>