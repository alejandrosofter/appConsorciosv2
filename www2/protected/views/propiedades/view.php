<?php
$this->breadcrumbs=array(
	'Propiedades'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Propiedades','url'=>array('index')),
array('label'=>'Create Propiedades','url'=>array('create')),
array('label'=>'Update Propiedades','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Propiedades','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Propiedades','url'=>array('admin')),
);
?>

<h1>View Propiedades #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombrePropiedad',
		'idTipoPropiedad',
		'idEdificio',
		'idPropiedadPadre',
		'estado',
),
)); ?>
