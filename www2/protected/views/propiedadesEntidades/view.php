<?php
$this->breadcrumbs=array(
	'Propiedades Entidades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PropiedadesEntidades', 'url'=>array('index')),
	array('label'=>'Create PropiedadesEntidades', 'url'=>array('create')),
	array('label'=>'Update PropiedadesEntidades', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PropiedadesEntidades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropiedadesEntidades', 'url'=>array('admin')),
);
?>

<h1>View PropiedadesEntidades #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idPropiedad',
		'idEntidad',
		'idTipoEntidadPropiedad',
		'fecha',
		'paga',
	),
)); ?>
