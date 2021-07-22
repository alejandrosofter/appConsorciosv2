<?php
$this->breadcrumbs=array(
	'Contratos Cuotases'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ContratosCuotas','url'=>array('index')),
array('label'=>'Create ContratosCuotas','url'=>array('create')),
array('label'=>'Update ContratosCuotas','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ContratosCuotas','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ContratosCuotas','url'=>array('admin')),
);
?>

<h1>View ContratosCuotas #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'idContrato',
		'desdeCuota',
		'hastaCuota',
		'importe',
),
)); ?>
