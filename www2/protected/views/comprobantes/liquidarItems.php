
<div id='conteItems' class='row'>

	<div class='span8'>
		<h1><img src='images/iconos/glyphicons/glyphicons_267_credit_card.png'/> Liquidar <?=$this->renderPartial('busquedaPropiedades',array('edificios'=>$edificios,'anterior'=>$anterior));?></h1>
		<div id='resultadosDeuda'>
		<i>No se ha realizado ningúna busqueda</i></div>
	</div>
	<div class='span4'>
		<h3><img src='images/iconos/glyphicons/glyphicons_072_bookmark.png'/> Items a Liquidar</h3>
		<div id='itemsAliquidar'><?=$this->renderPartial('itemsLiquidar');?></div>
	</div>
	<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
'id'=>'ventanaLiquidar',
'options'=>array(
    'title'=>"<img src='images/iconos/glyphicons/glyphicons_150_edit.png'/> FINALIZAR LIQUIDACIÓN <small class='muted'> Generar comprobante</small>",
    'autoOpen'=>false,
    'position'=>array('x'=>50,'y'=>50),
    'modal'=>true,
    'open'=>'js:function(event, ui) {initLiquidacion() }',
    'resizable'=>false,
    'close'=>'js:function(e,o){$(this).dialog("close");$(".btn").button("reset");}' ,
    'buttons' => array(
        array('text'=>'Cerrar','click'=> 'js:function(){$(this).dialog("close");$(".btn").button("reset");}'),
        array('text'=>'Aceptar','class'=>'btn btn-primary','click'=> 'js:function(){liquidar();}'),
    ),
),
));
?>
<?=$this->renderPartial('dataLiquidacion',array('model'=>$model));?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
</div>
