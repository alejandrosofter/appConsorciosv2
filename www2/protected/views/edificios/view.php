<?php
$this->breadcrumbs=array(
	'Edificioses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Edificios','url'=>array('index')),
array('label'=>'Create Edificios','url'=>array('create')),
array('label'=>'Update Edificios','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Edificios','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Edificios','url'=>array('admin')),
);
?>

<h1>View Edificios #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombreEdificio',
		'domicilio',
		'telefono',
		'nombrePortero',
		'email',
		'cuit',
		'lugarPago',
		'idCondicionIva',
		'proximoRecibo',
		'importeFondoReserva',
		'localidad',
		'provincia',
		'cp',
		'interes',
		'interesDiaDesde',
		'fechaInicio',
		'idTalonario',
),
)); ?>
