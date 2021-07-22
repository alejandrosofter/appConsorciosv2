<?php
$this->breadcrumbs=array(
	'Articuloses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Articulos','url'=>array('index')),
array('label'=>'Create Articulos','url'=>array('create')),
array('label'=>'Update Articulos','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Articulos','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Articulos','url'=>array('admin')),
);
?>

<h1>View Articulos #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombreArticulo',
		'posicion',
		'texto',
		'fechaModificacion',
),
)); ?>
