<?php
$this->breadcrumbs=array(
	'Gastos Frecuentes',
);

$this->menu=array(
array('label'=>'Nuevo Gasto Frecuente','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_229_retweet_2.png'/> Gastos Frecuentes<small> de expensas</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('value'=>'$data->edificio->nombreEdificio', 'header'=>'Edificio'), 
array('value'=>'$data->tipoGasto->nombreTipoGasto', 'header'=>'Tipo de Gasto'), 
array('value'=>'$data->entidad->razonSocial', 'header'=>'Entidad'), 
array('value'=>'$data->tipoComprobante->nombreTipoComprobante', 'header'=>'Tipo de Comprobante'), 
array('name'=>'detalle', 'header'=>'Detalle'), 
	array('type'=>'html','value'=>'"<small><small>".$data->labelPorcentajes."</small></small>"', 'header'=>'%'), 
array('type'=>'html','value'=>'"<strong style=\"color:black\"> $ ".number_format($data->importe,2)."</strong>"', 'header'=>'Importe'), 
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
