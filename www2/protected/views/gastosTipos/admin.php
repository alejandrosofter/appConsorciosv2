<?php
$this->breadcrumbs=array(
	'Gastos Tiposes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar GastosTipos', 'url'=>array('index')),
	array('label'=>'Nuevo GastosTipos', 'url'=>array('create')),
);


<h1>Administracion Gastos Tiposes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gastos-tipos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreTipoGasto',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
