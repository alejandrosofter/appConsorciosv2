<?php
$this->breadcrumbs=array(
	'Propiedades Entidades'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar PropiedadesEntidades', 'url'=>array('index')),
	array('label'=>'Nuevo PropiedadesEntidades', 'url'=>array('create')),
);


<h1>Administracion Propiedades Entidades</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'propiedades-entidades-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idPropiedad',
		'idEntidad',
		'idTipoEntidadPropiedad',
		'fecha',
		'paga',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
