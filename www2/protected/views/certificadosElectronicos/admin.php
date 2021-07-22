<?php
$this->breadcrumbs=array(
	'Certificados Electronicoses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar CertificadosElectronicos', 'url'=>array('index')),
	array('label'=>'Nuevo CertificadosElectronicos', 'url'=>array('create')),
);


<h1>Administracion Certificados Electronicoses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'certificados-electronicos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreCertificado',
		'fechaCreacion',
		'fechaExpira',
		'archivoCertificado',
		'archivoCsr',
		/*
		'archivoKey',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
