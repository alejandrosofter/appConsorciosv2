<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index')),
);
?>

<header id="page-header">
<h1 id="page-title">Nuevo Usuario</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>