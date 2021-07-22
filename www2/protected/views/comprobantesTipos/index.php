<?php
$this->breadcrumbs=array(
	'Tipos de Comprobantes',
);
$this->menu=array(
	array('label'=>'Nuevo Tipo', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Tipos de Comprobantes</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comprobantes-tipos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'nombreTipoComprobante',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
