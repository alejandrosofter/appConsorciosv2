<?php
$this->breadcrumbs=array(
	'Gastos Tiposes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GastosTipos', 'url'=>array('index')),
	array('label'=>'Create GastosTipos', 'url'=>array('create')),
	array('label'=>'Update GastosTipos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GastosTipos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GastosTipos', 'url'=>array('admin')),
);
?>

<h1>View GastosTipos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreTipoGasto',
	),
)); ?>
