<?php
$this->breadcrumbs=array(
	'Liquidaciones',
);

$this->menu=array(
array('label'=>'Nueva Liquidación','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_411_package.png'/> Liquidaciones<small> de expensas</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array( 
array('type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 80px')), 
array(
            'type'=>'html',
            'header'=>'Edificio',
            'value'=>'$data->edificio->nombreEdificio',
            'htmlOptions'=>array('style'=>'width: 120px'),
            ),
array(
            'type'=>'html',
            'header'=>'Detalle',
            'value'=>'$data->detalle==""?"Sin Detalle":$data->detalle',
            ),


array(
            'type'=>'html',
            'header'=>'$ fondo de reserva',
            'value'=>'"<strong>$ ".number_format($data->importeFondoReserva,2)."</strong>"',
            'htmlOptions'=>array('style'=>'width: 220px'),
            ), 
array(
            'type'=>'html',
            'header'=>'$ importe',
            'value'=>'"<strong>$ ".number_format($data->importe,2)."</strong>"',
            'htmlOptions'=>array('style'=>'width: 120px'),
            ),
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width:120px'),
		'template'=>'{enviaMail}  {imprimir} {imprimirReporte}  {update} {delete}',
            'buttons'=>array(
'enviaMail' => array(
                'label'=>'Envia Mail',
                'imageUrl'=>'images/iconos/glyphicons/glyphicons_123_message_out.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=liquidaciones/mails&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("liquidaciones.mails")',
            ),
                   'imprimirReporte' => array(
                'label'=>'Imprimir Gastos',
                'imageUrl'=>'images/iconos/glyphicons/salida2.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=liquidaciones/imprimirGastos&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("Pagos.index")',
            ),
            'imprimir' => array(
                'label'=>'Imprimir Expensas',
                'imageUrl'=>'images/iconos/glyphicons/salida.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=liquidaciones/imprimir&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("Pagos.index")',
            ),
             'delete' => array(
                'label'=>'Quitar',
                'url' => '"index.php?r=liquidaciones/quitarLiquidacion&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("liquidacionesGastos.quitar")',
            ),
              
                'gastos' => array(
                'label'=>'Gastos',
                'imageUrl'=>'images/iconos/glyphicons/money.png',
                
                'url' => '"index.php?r=liquidacionesGastos/index&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("liquidacionesGastos.index")',
            ),
                  
                    'paraCobrar' => array(
                'label'=>'Para Cobrar',
                'imageUrl'=>'images/iconos/glyphicons/grupo.png',
                
                'url' => '"index.php?r=liquidacionesParaCobrar/index&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("liquidacionesParaCobrar.index")',
            ),
            )


),
),
)); ?>
