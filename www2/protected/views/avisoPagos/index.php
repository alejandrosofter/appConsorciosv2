<?php
$this->breadcrumbs=array(
	'Aviso PAGOS',
);

$this->menu=array(
array('label'=>'Nuevo Edificio','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_089_building.png'/>  Aviso Pagos<small> informativo de edificios</small>

</h1>

<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fechaAviso)."</small>"', 'header'=>'Fecha'),
array('type'=>'html','value'=>'" ".($data->getEntidad())', 'header'=>'Entidad'),
array('type'=>'html','value'=>'"$ ".number_format($data->importe,2)', 'header'=>'Importe'), 
array('type'=>'html','name'=>'estado','value'=>'"<strong style=\"color:".($data->estado=="PENDIENTE"?"red":"green")."\">  ".($data->estado)."</strong>"', 'header'=>'Estado'), 
		/*
array('name'=>'cuit', 'header'=>'cuit'), 
array('name'=>'lugarPago', 'header'=>'lugarPago'), 
array('name'=>'idCondicionIva', 'header'=>'idCondicionIva'), 
array('name'=>'proximoRecibo', 'header'=>'proximoRecibo'), 
array('name'=>'importeFondoReserva', 'header'=>'importeFondoReserva'), 
 
array('name'=>'cp', 'header'=>'cp'), 
array('name'=>'interes', 'header'=>'interes'), 
array('name'=>'interesDiaDesde', 'header'=>'interesDiaDesde'), 
array('name'=>'fechaInicio', 'header'=>'fechaInicio'), 
array('name'=>'idTalonario', 'header'=>'idTalonario'), 
		*/
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{acreditar} {verImagen}  {delete}',
  'buttons'=>array(
'acreditar' => array(
                'label'=>'Acredita',
                'imageUrl'=>'images/iconos/glyphicons/glyphicons_323_calculator.png',
                //'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=avisoPagos/acreditar&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("avisoPagos.acreditar")',
            ),
'verImagen' => array(
                'label'=>'Ver Comprobante',
                'imageUrl'=>'images/iconos/glyphicons/glyphicons_138_picture.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=avisoPagos/verImagen&id=".$data->id',
                'visible'=>'Yii::app()->user->checkAccess("avisoPagos.verImagen")',
            )
)

),
),
)); ?>
