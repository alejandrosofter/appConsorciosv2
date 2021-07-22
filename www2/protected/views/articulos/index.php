<?php
$this->breadcrumbs=array(
	'Articulos',
);

$this->menu=array(
array('label'=>'Nuevo Articulo','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_340_globe.png'/> Articulos<small> </small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'nombreArticulo', 'header'=>'Articulo'), 
array('name'=>'posicion', 'header'=>'Posicion'), 
array('name'=>'fechaModificacion', 'header'=>'Modificacion'), 
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
