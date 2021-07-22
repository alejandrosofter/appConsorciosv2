<?php
$this->breadcrumbs=array(
	'Para Cobrar',
);

$this->menu=array(
array('label'=>'Nueva Deuda','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_132_inbox_minus.png'/> Para Cobrar<small> deuda de expensas, contratos etc</small>
<div style='float:right'><?php $this->renderPartial('_search',array('model'=>$dataProvider));?></div> 
</h1>

<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
 'rowCssClassExpression'=>'$data->getColor()',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'detalle', 'header'=>'Detalle'), 
array('type'=>'html','value'=>'"<small>".($data->punitorio==""?"-":$data->punitorio)."</small>"', 'header'=>'Pun.'), 
array('name'=>'propiedad.nombrePropiedad', 'header'=>'Propiedad'), 
array('name'=>'entidad.razonSocial', 'header'=>'Entidad'),
array('name'=>'fechaVencimiento','type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fechaVencimiento)."</small>"', 'header'=>'Vto.'), 
array('type'=>'html','value'=>'"<strong style=\"color:".($data->estado=="PENDIENTE"?"red":"green")."\"> ".($data->estado)."</strong>"', 'header'=>'$ Saldo'), 
array('type'=>'html','value'=>'"$ ".number_format($data->importe,2)', 'header'=>'$ Total'), 
		/*
array('value'=>'"<strong style=\"color:".($data->estado=="PENDIENTE"?"red":"green")."\"> $ ".number_format($data->importeSaldo,2)."</strong>"', 'header'=>'Saldo'), 
array('name'=>'idTipoParaCobrar', 'header'=>'idTipoParaCobrar'), 
array('name'=>'importeSaldo', 'header'=>'importeSaldo'), 
		*/
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
