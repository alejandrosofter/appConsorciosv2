<?php
$this->breadcrumbs=array(
	'Propiedades'=>array('/propiedades'),
	'Entidades '.$propiedad->nombrePropiedad
);
$this->menu=array(
	array('label'=>'Nueva entidad', 'url'=>array('create&id='.$_GET['id'])),
);
?>

<header id="page-header">
<h1 id="page-title">Entidades <?=$propiedad->nombrePropiedad;?></h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'propiedades-entidades-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 80px'),
            ),
		'entidad.razonSocial',
		'tipo.nombreEntidadTipo',
		
		array(
            'type'=>'html',
            'header'=>'Paga',
            'value'=>'$data->paga?"Sí":"No"',
            'htmlOptions'=>array('style'=>'width: 80px'),
            ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
