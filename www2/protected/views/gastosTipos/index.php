<?php
$this->breadcrumbs=array(
	'Tipo de Gastos',
);
$this->menu=array(
	array('label'=>'Nuevo GastosTipos', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Tipo de Gastos</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gastos-tipos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'nombreTipoGasto',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
