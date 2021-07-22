<?php
$this->breadcrumbs=array(
        'Comprobantes',
);

$this->menu=array(
array('label'=>'Nuevo Comprobante','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_150_edit.png'/> Comprobantes<small> de entrada y salida</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
    array('name'=>'nroComprobante','value'=>'$data->nroComprobante==""?"-":$data->nroComprobante', 'header'=>'Nro.'), 
array('type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fecha)."</small>"', 'header'=>'Fecha'), 
array('value'=>'$data->entidad->razonSocial', 'header'=>'Entidad'), 
array('name'=>'detalle', 'header'=>'Detalle'), 
array('name'=>'estado', 'header'=>'Estado'), 
array('value'=>'$data->idTalonario==null?"no":$data->talonario->nombreTalonario', 'header'=>'Talonario'), 
array('value'=>'"$ ".number_format($data->bonificacion,2)', 'header'=>'Bonif.'), 
array('value'=>'"$ ".number_format($data->interes,2)', 'header'=>'Interés'), 

array('type'=>'html','value'=>'"$ ".number_format($data->importeTotal,2)', 'header'=>'Importe'), 
array('value'=>'"$ ".number_format($data->importePagado,2)', 'header'=>'Pagado'),
array('type'=>'html','value'=>'"<strong style=\"color:".($data->estado=="PENDIENTE"?"red":"green")."\"> $ ".number_format($data->importeTotal-$data->importePagado+$data->interes-$data->bonificacion,2)."</strong>"', 'header'=>'Saldo$'),

array(
'htmlOptions' => array('nowrap'=>'nowrap'),
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{pagos}  {enviaMail} {imprimir} {delete}',
                'buttons'=>array(
                                 'imprimir' => array(
                'label'=>'Imprimir',
                'imageUrl'=>'images/iconos/glyphicons/imprimir.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=comprobantes/imprimir&id=".$data->id',
                'visible'=>'$data->idTalonario!=null',
            ),
                 'pagos' => array(
                'label'=>'Pagos',
                'imageUrl'=>'images/iconos/glyphicons/money.png',
                //'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=pagos/index&id=".$data->id',
            ),
                                 'enviaMail' => array(
                'label'=>'Envia Mail',
                'imageUrl'=>'images/iconos/glyphicons/glyphicons_123_message_out.png',
                'options'=>array('class'=>'chico','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=comprobantes/enviaEmailComprobante&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("comprobantes.enviaEmailComprobante")',
            ),
                        ),


),
),
)); ?>
