<?php
$this->breadcrumbs=array(
	'Propiedades Consultases'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List PropiedadesConsultas','url'=>array('index')),
array('label'=>'Create PropiedadesConsultas','url'=>array('create')),
array('label'=>'Update PropiedadesConsultas','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete PropiedadesConsultas','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage PropiedadesConsultas','url'=>array('admin')),
);
?>

<h1>View PropiedadesConsultas #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'fecha',
		'solicitante',
		'telefonos',
		'email',
		'observaciones',
		'estado',
		'tipoConsulta',
		'importeDesde',
		'importeHasta',
		'idTipoPropiedad',
		'idUbicacion',
		'cantidadHabitaciones',
		'cantidadBanos',
		'tienePatio',
		'tieneQuincho',
		'publicaWeb',
),
)); ?>
