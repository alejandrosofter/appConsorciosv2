<?php 
$this->breadcrumbs=array(
    'Settings'=>array('Settings/admin'),
	'Plantillas',
);


$this->menu=array(
	array('label'=>'Agregar plantilla', 'url'=>array('create')),
	array('label'=>'Volver a Settings', 'url'=>array('admin')),
);

?>


<h1>PLANTILLAS</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->filtrarPlantilla(),
	'columns'=>array(
		//'id',
	//	'key',
	//	'value',
	//	'categoria',
	//	'subCategoria',
		'descripcion',
		array(
			'class'=>'CButtonColumn','template' => '{update}{delete}',
		),
	),
)); ?>