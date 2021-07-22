<?php
$this->breadcrumbs=array(
	'Comprobantes Tiposes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar ComprobantesTipos', 'url'=>array('index')),
	array('label'=>'Nuevo ComprobantesTipos', 'url'=>array('create')),
);


<h1>Administracion Comprobantes Tiposes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comprobantes-tipos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreTipoComprobante',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
