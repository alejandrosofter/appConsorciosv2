<?php
$this->breadcrumbs=array(
	'Consultas',
);

$this->menu=array(
array('label'=>'Nueva Consulta','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_309_comments.png'/> Consultas<small> sobre Propiedades</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
 'rowCssClassExpression'=>'$data->getColor()',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fecha)."</small>"', 'header'=>'Fecha'), 

array('name'=>'solicitante', 'header'=>'Solicitante'), 
array('name'=>'telefonos', 'header'=>'Tel.'), 
array('name'=>'email', 'header'=>'Email'), 
array('name'=>'importeDesde', 'header'=>'$Desde'), 
array('name'=>'importeHasta', 'header'=>'$Hasta'), 
array('name'=>'observaciones', 'header'=>'Obs.'), 
array('name'=>'tipoConsulta', 'header'=>'Tipo de Consulta'), 
		/*
array('name'=>'estado', 'header'=>'estado'), 
array('name'=>'tipoConsulta', 'header'=>'tipoConsulta'), 
array('name'=>'importeDesde', 'header'=>'importeDesde'), 
array('name'=>'importeHasta', 'header'=>'importeHasta'), 
array('name'=>'idTipoPropiedad', 'header'=>'idTipoPropiedad'), 
array('name'=>'idUbicacion', 'header'=>'idUbicacion'), 
array('name'=>'cantidadHabitaciones', 'header'=>'cantidadHabitaciones'), 
array('name'=>'cantidadBanos', 'header'=>'cantidadBanos'), 
array('name'=>'tienePatio', 'header'=>'tienePatio'), 
array('name'=>'tieneQuincho', 'header'=>'tieneQuincho'), 
array('name'=>'publicaWeb', 'header'=>'publicaWeb'), 
		*/
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
