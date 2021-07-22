<?php
$this->breadcrumbs=array(
	'Propiedades Porcentajes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PropiedadesPorcentajes', 'url'=>array('index')),
	array('label'=>'Nuevo PropiedadesPorcentajes', 'url'=>array('create')),
);


<h1>Administracion Propiedades Porcentajes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'propiedades-porcentajes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'porcentaje',
		'idTipoGasto',
		'idPropiedad',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
