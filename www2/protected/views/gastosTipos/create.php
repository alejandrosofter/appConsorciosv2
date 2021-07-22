<?php
$this->breadcrumbs=array(
	'Gastos Tiposes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar GastosTipos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo GastosTipos</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>