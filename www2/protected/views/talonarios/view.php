<?php
$this->breadcrumbs=array(
	'Talonarioses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Talonarios','url'=>array('index')),
array('label'=>'Create Talonarios','url'=>array('create')),
array('label'=>'Update Talonarios','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Talonarios','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Talonarios','url'=>array('admin')),
);
?>

<h1>View Talonarios #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'desde',
		'hasta',
		'serie',
		'proximo',
		'idTipoTalonario',
		'letraTalonario',
		'esPedeterminado',
		'esElectronico',
		'idCertificadoElectronico',
		'idPlantilla',
		'nombreTalonario',
),
)); ?>
