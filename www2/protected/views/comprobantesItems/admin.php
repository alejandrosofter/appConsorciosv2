<?php
$this->breadcrumbs=array(
	'Comprobantes Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar ComprobantesItems', 'url'=>array('index')),
	array('label'=>'Nuevo ComprobantesItems', 'url'=>array('create')),
);


<h1>Administracion Comprobantes Items</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comprobantes-items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
