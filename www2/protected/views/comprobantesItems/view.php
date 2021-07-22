<?php
$this->breadcrumbs=array(
	'Comprobantes Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ComprobantesItems', 'url'=>array('index')),
	array('label'=>'Create ComprobantesItems', 'url'=>array('create')),
	array('label'=>'Update ComprobantesItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ComprobantesItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ComprobantesItems', 'url'=>array('admin')),
);
?>

<h1>View ComprobantesItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idComprobante',
		'detalle',
		'cantidad',
		'importe',
		'decuentoInteres',
	),
)); ?>
