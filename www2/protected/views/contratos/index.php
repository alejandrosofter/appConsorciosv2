<?php
$this->breadcrumbs=array(
	'Contratos',
);

$this->menu=array(
array('label'=>'Nuevo Contrato','url'=>array('create')),
);
?>

<h1><img src='images/iconos/glyphicons/glyphicons_036_file.png'/>  Contratos<small> de propiedades</small>
<div style="float:right"><?php $this->renderPartial('_search',array('model'=>$dataProvider));?> 
</div></h1>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'json'=>true,
'type' => 'condensed',
 'rowCssClassExpression'=>'$data->getColor()',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
array('name'=>'id', 'header'=>''), 
array('name'=>'inmueble.nombrePropiedad','type'=>'html','value'=>'"<b>".$data->inmueble->nombrePropiedad."</b>"', 'header'=>'Inmueble'), 
array('name'=>'locador.razonSocial', 'header'=>'Locador'), 
array('name'=>'locatario.razonSocial', 'header'=>'Locatario'), 
array('name'=>'fechaInicio','type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fechaInicio)."</small>"', 'header'=>'Fecha Inicio'), 
array('name'=>'fechaVencimiento','type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fechaVencimiento)."</small>"', 'header'=>'Fecha Venc.'), 
array('name'=>'comisionAdministracion','value'=>'$data->comisionAdministracion==""?"-":$data->comisionAdministracion', 'header'=>'Comision'), 
array('name'=>'punitoriosDia', 'value'=>'$data->punitoriosDia==""?"-":$data->punitoriosDia','header'=>'Punitorios'), 
array('name'=>'cuota', 'header'=>'Cuotas'), 
array('name'=>'estado', 'header'=>'Estado'), 	/*
array('name'=>'idPlantilla', 'header'=>'idPlantilla'), 
array('name'=>'fechaRecesion', 'header'=>'fechaRecesion'), 
array('name'=>'depositoGarantia', 'header'=>'depositoGarantia'), 
array('name'=>'comisionAdministracion', 'header'=>'comisionAdministracion'), 
array('name'=>'punitoriosDia', 'header'=>'punitoriosDia'), 
		*/
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{Imprimir} {Renovar} {Rescindir} {update} {delete}',
		'buttons'=>array(
       'Imprimir' => array(
                'label'=>'',
               // 'imageUrl'=>'icon-hdd',
                'options'=>array('class'=>'icon-print imprime','title'=>'Imprimir','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=contratos/imprimir&id=".$data->id',
            ),
				 'Renovar' => array(
                'label'=>'',
              //'imageUrl'=>'images/iconos/glyphicons/glyphicons_082_roundabout.png',
                'visible'=>'!(($data->estado=="RESCINDIDO") || ($data->estado=="RENOVADO"))',
                'options'=>array('class'=>' icon-retweet','title'=>'Renovar'),
                'url' => '"index.php?r=contratos/renovar&id=".$data->id',
            ),
				 'Rescindir' => array(
                'label'=>'',
                'click'=>'function(){recindir($(this).parent().parent().children(":nth-child(1)").text())}',
                'options'=>array('class'=>'icon-ban-circle','title'=>'Rescindir'),
                'visible'=>'!(($data->estado=="RESCINDIDO") || ($data->estado=="RENOVADO"))'
               // 'url' => '#',
            ),
		)

),
),
)); ?>
<script>
function recindir(id)
{
	 if (confirm("Realmente queres rescindir el contrato "+id+'?') == true) {
        cargar(id);
    }
}
function cargar(id)
{
	$.get( "index.php?r=contratos/rescindir&id="+id, function( data ) {
		location.reload();
	});
}
</script>