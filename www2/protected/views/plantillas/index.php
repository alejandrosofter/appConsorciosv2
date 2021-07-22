<?php
$this->breadcrumbs=array(
	'Plantillas',
);

$this->menu=array(
	array('label'=>'Nueva', 'url'=>array('create')),
);
?>

<h1>Plantillas</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'periodos-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'titulo',
		'clave',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>