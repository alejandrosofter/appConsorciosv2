<?php
$this->breadcrumbs=array(
	'Configuraciones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Create Settings', 'url'=>array('create')),
	array('label'=>'Usuarios', 'url'=>array('/usuarios')),
	array('label'=>'Log', 'url'=>array('/log')),
	array('label'=>'Manage Settings', 'url'=>array('admin')),
);
?>

<h1>Create Settings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>