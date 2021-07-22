<?php
$this->breadcrumbs=array(
	'Edificios Gastos Frecuentes'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List EdificiosGastosFrecuentes','url'=>array('index')),
array('label'=>'Create EdificiosGastosFrecuentes','url'=>array('create')),
array('label'=>'Update EdificiosGastosFrecuentes','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete EdificiosGastosFrecuentes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage EdificiosGastosFrecuentes','url'=>array('admin')),
);
?>

<h1>View EdificiosGastosFrecuentes #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'idEdificio',
		'idTipoGasto',
		'idEntidad',
		'idTipoComprobante',
		'detalle',
		'importe',
),
)); ?>
