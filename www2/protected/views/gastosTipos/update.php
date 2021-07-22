<?php
$this->breadcrumbs=array(
	'Gastos Tiposes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar GastosTipos', 'url'=>array('index')),
	array('label'=>'Nuevo GastosTipos', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro GastosTipos <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>