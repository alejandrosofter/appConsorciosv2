<?php
$this->breadcrumbs=array(
	'Liquidaciones Para Cobrars'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar LiquidacionesParaCobrar', 'url'=>array('index')),
	array('label'=>'Nuevo LiquidacionesParaCobrar', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro LiquidacionesParaCobrar <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>