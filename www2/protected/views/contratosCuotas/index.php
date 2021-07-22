<?php
$this->breadcrumbs=array(
	'Contratos Cuotases',
);

$this->menu=array(
array('label'=>'Nuevo ContratosCuotas','url'=>array('create')),
);
?>

<h1>Contratos Cuotases<small> </small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'id', 'header'=>'id'), 
array('name'=>'idContrato', 'header'=>'idContrato'), 
array('name'=>'desdeCuota', 'header'=>'desdeCuota'), 
array('name'=>'hastaCuota', 'header'=>'hastaCuota'), 
array('name'=>'importe', 'header'=>'importe'), 
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
