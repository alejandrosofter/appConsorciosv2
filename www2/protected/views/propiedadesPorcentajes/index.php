<?php
$this->breadcrumbs=array(
	'Propiedades'=>array('/propiedades'),
	'Porcentajes '.$propiedad->nombrePropiedad
);
$this->menu=array(
	array('label'=>'Nuevo Porcentaje', 'url'=>array('create&id='.$model->idPropiedad)),
);
?>

<header id="page-header">
<h1 id="page-title">Procentajes <?=$propiedad->nombrePropiedad;?></h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'propiedades-porcentajes-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'%',
            'value'=>'$data->porcentaje." %"',
            'htmlOptions'=>array('style'=>'width: 80px'),
            ),
		'tipo.nombreTipoPropiedad',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
