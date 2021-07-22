<?php
$this->breadcrumbs=array(
	'Liquidaciones Gastoses',
);

$this->menu=array(
array('label'=>'Nuevo LiquidacionesGastos','url'=>array('create')),
);
?>

<h1>Liquidaciones Gastoses<small> </small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'id', 'header'=>'id'), 
array('name'=>'idLiquidacion', 'header'=>'idLiquidacion'), 
array('name'=>'idGasto', 'header'=>'idGasto'), 
array('name'=>'importe', 'header'=>'importe'), 
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
