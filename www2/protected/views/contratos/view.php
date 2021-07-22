<?php
$this->breadcrumbs=array(
	'Contratoses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Contratos','url'=>array('index')),
array('label'=>'Create Contratos','url'=>array('create')),
array('label'=>'Update Contratos','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Contratos','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Contratos','url'=>array('admin')),
);
?>

<h1>View Contratos #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'idDominio',
		'idEntidadLocador',
		'idEntidadLocatario',
		'fechaInicio',
		'fechaVencimiento',
		'idPlantilla',
		'fechaRecesion',
		'depositoGarantia',
		'comisionAdministracion',
		'punitoriosDia',
),
)); ?>
