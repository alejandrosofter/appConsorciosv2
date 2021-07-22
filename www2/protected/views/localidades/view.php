<?php
$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Localidades','url'=>array('index')),
array('label'=>'Create Localidades','url'=>array('create')),
array('label'=>'Update Localidades','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Localidades','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Localidades','url'=>array('admin')),
);
?>

<h1>View Localidades #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombreLocalidad',
),
)); ?>
