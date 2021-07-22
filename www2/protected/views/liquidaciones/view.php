<?php
$this->breadcrumbs=array(
	'Liquidaciones'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Liquidaciones','url'=>array('index')),
array('label'=>'Create Liquidaciones','url'=>array('create')),
array('label'=>'Update Liquidaciones','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Liquidaciones','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Liquidaciones','url'=>array('admin')),
);
?>

<h1>View Liquidaciones #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'fecha',
		'detalle',
		'idEdificio',
		'importe',
		'importeFondoReserva',
),
)); ?>
