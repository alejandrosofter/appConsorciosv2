<?php
$this->breadcrumbs=array(
	'Comprobantes Tiposes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ComprobantesTipos', 'url'=>array('index')),
	array('label'=>'Create ComprobantesTipos', 'url'=>array('create')),
	array('label'=>'Update ComprobantesTipos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ComprobantesTipos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ComprobantesTipos', 'url'=>array('admin')),
);
?>

<h1>View ComprobantesTipos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreTipoComprobante',
	),
)); ?>
