<style>
.padre {
  background: rgb(171, 183, 184);
  font-weight: bold;
}
.hijo {
  
  background: rgb(201, 217, 219);
  font-size: 10px;
}
</style>
<?php
$this->breadcrumbs=array(
	'Propiedades',
);

$this->menu=array(
array('label'=>'Nueva Propiedad','url'=>array('create')),
);
?>
<div style='float:right'><small><b>% DEPTOS:</b> <?=$dataProvider->getPorcentajeEdificio(1)?> <b>% COCHERA:</b> <?=$dataProvider->getPorcentajeEdificio(2)?> <b>% LOCAL:</b> <?=$dataProvider->getPorcentajeEdificio(3)?></small>
	 <b> TOTAL: <?=$dataProvider->getPorcentajeEdificio(1)+$dataProvider->getPorcentajeEdificio(2)+$dataProvider->getPorcentajeEdificio(3)?> </b> </div>

<h1><img src='images/iconos/glyphicons/glyphicons_263_bank.png'/> Propiedades<small> expensas de edificios</small>
<div style='float:right'><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> </div>
	
</h1>

<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
 'rowCssClassExpression'=>'$data->getColor()',
'columns'=>array(
	array('name'=>'ordenamiento', 'header'=>'Ord.'), 
array('type'=>'html', 'name'=>'tipoPropiedad.nombreTipoPropiedad','value'=>'"<img title=\'".$data->tipoPropiedad->nombreTipoPropiedad."\' src=\'images/iconos/glyphicons/".$data->tipoPropiedad->nombreTipoPropiedad.".png\'"', 'header'=>'Tipo'), 
array('type'=>'html', 'name'=>'tieneCochera','value'=>'($data->tieneCochera)?"<img title=\'Tiene cochera\' width=\'30px\' src=\'images/iconos/glyphicons/Cochera.png\'":""', 'header'=>''), 

array('name'=>'nombrePropiedad','value'=>'$data->nombreGrilla', 'header'=>'Propiedad'),
array('name'=>'edificio.nombreEdificio', 'header'=>'Edificio'), 
array('type'=>'html','value'=>'"<big style=\"color:blue\">".($data->entidadPaga!=null?$data->entidadPaga->razonSocial:"sin entidad")."</big>"', 'header'=>'Paga'), 
array('type'=>'html','value'=>'"<small style=\"color:".($data->estado=="ACTIVA"?"green":"red")."\" >".$data->estado."</small>"', 'header'=>'Estado'), 
array('name'=>'porcentaje', 'header'=>'% UF'), 
array('name'=>'porcentajeCochera','value'=>'($data->porcentajeCochera==""||$data->porcentajeCochera==0)?"-":$data->porcentajeCochera', 'header'=>'% Cochera'), 
array('name'=>'propietario.razonSocial','value'=>'isset($data->propietario)?$data->propietario->razonSocial:"-"', 'header'=>'Propietario'), 
array('name'=>'inquilino.razonSocial','value'=>'isset($data->inquilino)?$data->inquilino->razonSocial:"-"', 'header'=>'Inquilino'), 

array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); 
?>
