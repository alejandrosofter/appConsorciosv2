<?php
$this->breadcrumbs=array(
	//'Registro'=>array('/auditTrail'),
	'Registros',
);
/*
$this->menu=array(
	array('label'=>'List AuditTrail', 'url'=>array('index')),
	array('label'=>'Create AuditTrail', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('audit-trail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrador de Registros</h1>

<p>
Tambien puedes usar caracterede de compraracion (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) al principio de cada campo.
</p>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $auditTrail = AuditTrail::model()->recently();$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'audit-trail-grid',
	'dataProvider'=>$auditTrail->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'old_value',
		'new_value',
		'action',
		'model',
		'field',
		'stamp' => array(
				'name' => 'stamp',
				'filter'=> '',
				'header'=>'Fecha',
				'type'=>'html',
				'value'=>'CHtml::link($data->stamp,"#",array("rel"=>"twipsy","title"=>"ESTADOS <br> $data->estados"))',
			),
		'nombreUsuario',

//		array(
//			'class'=>'CButtonColumn',
//		),
	),
));$this->widget('ext.bootstrap.widgets.BootTwipsy',array(
    'selector'=>'a[title]',
)); ?>