<?php
$this->breadcrumbs=array(
	'Edificios',
);

$this->menu=array(
array('label'=>'Nuevo Edificio','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_089_building.png'/>  Edificios<small> informativo de edificios</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> </div>
</h1>

<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'nombreEdificio', 'header'=>'Nombre del Edificio'), 
array('name'=>'domicilio', 'header'=>'Domicilio'), 
array('name'=>'telefono', 'header'=>'Tel.'), 
array('name'=>'nombrePortero', 'header'=>'Portero'), 
array('name'=>'email', 'header'=>'E-mail'), 
array('name'=>'localidad', 'header'=>'Localidad'), 
array('name'=>'provincia', 'header'=>'Provincia'),
array('name'=>'talonario.nombreTalonario', 'header'=>'Talonario'), 
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
		'template'=>'{enviaMail} {update} {delete}',
		'buttons'=>array(
                            
                                 'enviaMail' => array(
                'label'=>'Envia Mail',
                'imageUrl'=>'images/iconos/glyphicons/glyphicons_123_message_out.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=Edificios/enviaEmail&id=".$data->id',
            ),
                        ),


),
),
)); ?>
