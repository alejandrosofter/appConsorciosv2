<?php
$this->breadcrumbs=array(
	'Entidades',
);

$this->menu=array(
array('label'=>'Nuevo Entidades','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_024_parents.png'/> Entidades <small>Inquilinos, Propietarios, Inmobiliario etc...</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> </div></h1>

<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'dataProvider'=>$dataProvider->search(),
'type'=>'condensed',
'columns'=>array(
array('name'=>'razonSocial', 'header'=>'Razón Social'), 
array('name'=>'tipoEntidad.nombreTipoEntidad', 'header'=>'Tipo de Entidad'), 
array('name'=>'telefono', 'header'=>'Tel.'), 
array('name'=>'email', 'header'=>'email'), 
array('name'=>'condicionIva.nombreIva', 'header'=>'Cond. IVA'), 
array('type'=>'html','value'=>'"<strong style=\"color:green\"> $ ".number_format($data->importeFavor,2)."</strong>"', 'header'=>'Importe a Favor'), 


		/*
array('name'=>'$data->cuit', 'header'=>'idTipoEntidad'), 
array('name'=>'cuit', 'header'=>'cuit'), 
array('name'=>'domicilio', 'header'=>'domicilio'), 
array('name'=>'detalle', 'header'=>'detalle'), 
		*/
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
<script>
$('#Entidades_buscar').tooltip();
</script>