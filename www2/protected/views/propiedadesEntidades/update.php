<?php
$this->breadcrumbs=array(
	'Propiedades Entidades'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar PropiedadesEntidades', 'url'=>array('index')),
	array('label'=>'Nuevo PropiedadesEntidades', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro PropiedadesEntidades <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>