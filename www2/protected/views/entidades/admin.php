<?php
$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Entidades', 'url'=>array('index')),
	array('label'=>'Nuevo Entidades', 'url'=>array('create')),
);


<h1>Administracion Entidades</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'entidades-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'razonSocial',
		'idCondicionIva',
		'telefono',
		'email',
		/*
		'idTipoEntidad',
		'cuit',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
