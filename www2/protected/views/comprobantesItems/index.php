<?php
$this->breadcrumbs=array(
	'Comprobantes Items',
);
$this->menu=array(
	array('label'=>'Nuevo ComprobantesItems', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Comprobantes Items</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comprobantes-items-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'idComprobante',
		'detalle',
		'cantidad',
		'importe',
		'decuentoInteres',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
