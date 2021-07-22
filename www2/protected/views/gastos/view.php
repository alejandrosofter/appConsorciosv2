<?php
$this->breadcrumbs=array(
	'Gastoses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Gastos','url'=>array('index')),
array('label'=>'Create Gastos','url'=>array('create')),
array('label'=>'Update Gastos','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Gastos','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Gastos','url'=>array('admin')),
);
?>

<h1>View Gastos #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'idEdificio',
		'idTipoGasto',
		'estado',
		'idComprobante',
		'idGastoLigado',
		'esFondoReserva',
),
)); ?>
