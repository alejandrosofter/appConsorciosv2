<?php
$this->breadcrumbs=array(
	'Configuraciones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Settings', 'url'=>array('create')),
	array('label'=>'Usuarios', 'url'=>array('/usuarios')),
	array('label'=>'Log', 'url'=>array('/log')),
	array('label'=>'Manage Settings', 'url'=>array('admin')),
);
?>

<h1>View Settings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'key',
		'value:html',
	),
)); ?>
