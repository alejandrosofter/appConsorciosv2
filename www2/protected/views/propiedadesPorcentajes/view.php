<?php
$this->breadcrumbs=array(
	'Propiedades Porcentajes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PropiedadesPorcentajes', 'url'=>array('index')),
	array('label'=>'Create PropiedadesPorcentajes', 'url'=>array('create')),
	array('label'=>'Update PropiedadesPorcentajes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PropiedadesPorcentajes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropiedadesPorcentajes', 'url'=>array('admin')),
);
?>

<h1>View PropiedadesPorcentajes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'porcentaje',
		'idTipoGasto',
		'idPropiedad',
	),
)); ?>
