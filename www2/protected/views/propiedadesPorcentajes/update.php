<?php
$this->breadcrumbs=array(
	'Propiedades Porcentajes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PropiedadesPorcentajes', 'url'=>array('index')),
	array('label'=>'Nuevo PropiedadesPorcentajes', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PropiedadesPorcentajes <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>