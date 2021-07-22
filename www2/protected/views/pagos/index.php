<?php
$this->breadcrumbs=array(
	'Pagos',
);

$this->menu=array(
array('label'=>'Nuevo Pago','url'=>array('create&id='.$dataProvider->idComprobante)),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_227_usd.png'/> Pagos<small> de comprobantes</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'idComprobante','value'=>'$data->comprobante->nroComprobante==""?"s/n":$data->comprobante->nroComprobante', 'header'=>'Comprobante'), 
array('type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fecha)."</small>"', 'header'=>'Fecha'), 

array('type'=>'html','value'=>'"<strong> $ ".number_format($data->importe,2)."</strong>"', 'header'=>'Importe'), 

array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',
		'buttons'=>array(
				 
                 'pago' => array(
                'label'=>'Agregar pago',
                'imageUrl'=>'images/iconos/glyphicons/money.png',
                //'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=pagos/create&id=".$data->id',
            ),
				
			),

),
),
)); ?>
