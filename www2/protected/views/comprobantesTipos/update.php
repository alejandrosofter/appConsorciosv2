<?php
$this->breadcrumbs=array(
	'Comprobantes Tiposes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ComprobantesTipos', 'url'=>array('index')),
	array('label'=>'Nuevo ComprobantesTipos', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro ComprobantesTipos <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>