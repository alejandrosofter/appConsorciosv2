<?php
$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Entidades', 'url'=>array('index')),
	array('label'=>'Create Entidades', 'url'=>array('create')),
	array('label'=>'Update Entidades', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Entidades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Entidades', 'url'=>array('admin')),
);
?>

<h1>View Entidades #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'razonSocial',
		'idCondicionIva',
		'telefono',
		'email',
		'idTipoEntidad',
		'cuit',
	),
)); ?>
