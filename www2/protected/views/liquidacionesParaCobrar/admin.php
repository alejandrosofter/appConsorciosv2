<?php
$this->breadcrumbs=array(
	'Liquidaciones Para Cobrars'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar LiquidacionesParaCobrar', 'url'=>array('index')),
	array('label'=>'Nuevo LiquidacionesParaCobrar', 'url'=>array('create')),
);


<h1>Administracion Liquidaciones Para Cobrars</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'liquidaciones-para-cobrar-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idLiquidacion',
		'idParaCobrar',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
