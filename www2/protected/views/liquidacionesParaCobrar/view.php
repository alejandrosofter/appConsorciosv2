<?php
$this->breadcrumbs=array(
	'Liquidaciones Para Cobrars'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LiquidacionesParaCobrar', 'url'=>array('index')),
	array('label'=>'Create LiquidacionesParaCobrar', 'url'=>array('create')),
	array('label'=>'Update LiquidacionesParaCobrar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LiquidacionesParaCobrar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LiquidacionesParaCobrar', 'url'=>array('admin')),
);
?>

<h1>View LiquidacionesParaCobrar #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idLiquidacion',
		'idParaCobrar',
	),
)); ?>
