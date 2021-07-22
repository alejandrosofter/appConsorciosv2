<?php
$this->breadcrumbs=array(
	'Comprobantes Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ComprobantesItems', 'url'=>array('index')),
	array('label'=>'Nuevo ComprobantesItems', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro ComprobantesItems <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>