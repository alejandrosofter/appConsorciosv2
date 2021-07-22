<?php
$this->breadcrumbs=array(
	'Para Cobrars'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ParaCobrar','url'=>array('index')),
array('label'=>'Create ParaCobrar','url'=>array('create')),
array('label'=>'Update ParaCobrar','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ParaCobrar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ParaCobrar','url'=>array('admin')),
);
?>

<h1>View ParaCobrar #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'detalle',
		'fecha',
		'importe',
		'idPropiedad',
		'idEntidad',
		'estado',
		'idTipoParaCobrar',
		'importeSaldo',
),
)); ?>
