<?php
$this->breadcrumbs=array(
	'Configuraciones',
);

//$this->menu=array(
//	array('label'=>'Crear Settings', 'url'=>array('create')),
//	array('label'=>'Usuarios', 'url'=>array('/usuarios')),
//	array('label'=>'Log', 'url'=>array('/log')),
//	array('label'=>'Dolar', 'url'=>array('/valorMoneda')),
//	array('label'=>'Impresiones', 'url'=>array('/impresiones')),
//	array('label'=>'Centros Costo', 'url'=>array('/centrosCosto')),
//	array('label'=>'Actualizar Sistema SVN', 'url'=>array('actualizarSistema')),
//);
?>

<h1>CONFIGURACIONES</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
    'filter'=>$model,
	'columns'=>array(

		'category',
		'key',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
