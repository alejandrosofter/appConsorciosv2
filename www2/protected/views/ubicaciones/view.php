<?php
$this->breadcrumbs=array(
	'Ubicaciones'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Ubicaciones','url'=>array('index')),
array('label'=>'Create Ubicaciones','url'=>array('create')),
array('label'=>'Update Ubicaciones','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Ubicaciones','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Ubicaciones','url'=>array('admin')),
);
?>

<h1>View Ubicaciones #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombreUbicacion',
),
)); ?>
