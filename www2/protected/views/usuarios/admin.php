<?php
$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index')),
	array('label'=>'Nuevo Usuarios', 'url'=>array('create')),
);


<h1>Administracion Usuarioses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreUsuario',
		'clave',
		'fechaAlta',
		'email',
		'imagen',
		/*
		'esAdministrativo',
		'idEstado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
