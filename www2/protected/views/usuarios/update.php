<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index')),
	array('label'=>'Nuevo Usuarios', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Modificar Usuario <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>