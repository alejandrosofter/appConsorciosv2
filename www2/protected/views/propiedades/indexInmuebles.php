<?php
$this->breadcrumbs=array(
	'Inmuebles',
);

$this->menu=array(
array('label'=>'Nuevo Inmueble','url'=>array('createInmueble')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_263_bank.png'/> Inmuebles<small> disponibles para contratos</small>
<div style='float:right'><?php $this->renderPartial('_searchInmuebles',array('model'=>$dataProvider));?> </div>
</h1>


<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->searchInmuebles(),
 'rowCssClassExpression'=>'$data->getColor()',
'columns'=>array(
array('name'=>'nombrePropiedad', 'header'=>'Propiedad'), 
array('name'=>'tipoPropiedad.nombreTipoPropiedad', 'header'=>'Tipo'), 
array('name'=>'domicilio', 'header'=>'domicilio'),
array('name'=>'ubicacion.nombreUbicacion', 'header'=>'Ubicacion'),
array('name'=>'importe', 'header'=>'Importe'),
array('type'=>'html','value'=>'"<small>".$data->estado."</small>"', 'header'=>'Estado'), 

array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',
		'buttons'=>array(
				 'update' => array(
                'label'=>'Actualiza',
                'imageUrl'=>'images/iconos/glyphicons/icon-pencil.png',
                'url' => '"index.php?r=propiedades/updateInmueble&id=".$data->id',
            ),'delete' => array(
                'label'=>'Actualiza',
                'imageUrl'=>'images/iconos/glyphicons/icon-trash.png',
                'url' => '"index.php?r=propiedades/deleteInmueble&id=".$data->id',
            ),
				
			),


),
), 
)); 
?>
