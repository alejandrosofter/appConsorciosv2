<?php
$this->breadcrumbs=array(
	'Mails'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Mail', 'url'=>array('index')),
	array('label'=>'Nuevo Mail', 'url'=>array('create')),
);


<h1>Administracion Mails</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'emisor',
		'receptor',
		'mensaje',
		'fecha',
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
