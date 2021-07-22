<?php
$this->breadcrumbs=array(
	'Localidades',
);

$this->menu=array(
array('label'=>'Nueva Localidad','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_377_riflescope.png'/> Localidades<small> </small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'nombreLocalidad', 'header'=>'Nombre'), 
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
