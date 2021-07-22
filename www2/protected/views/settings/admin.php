<?php
$this->breadcrumbs=array(
	'Configuraciones'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Create Settings', 'url'=>array('create')),
	array('label'=>'Usuarios', 'url'=>array('/usuarios')),
	array('label'=>'Log', 'url'=>array('/log')),
	array('label'=>'Manage Settings', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('settings-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Settings</h1>

<p>
Puedes buscar por diferentes simbolos (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>).
</p>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'category',
		'key',
		'value',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
