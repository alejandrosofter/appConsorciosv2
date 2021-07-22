<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'comprobantes-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
	<div class='span3'>

			<?php echo $form->datepickerRow($model,'fecha',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>
<?php echo $form->datepickerRow($model,'fechaVencimiento',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>

			<?php echo $form->select2Row($model,'idEntidad',array('data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),'htmlOptions'=>array('onchange'=>'cambiaEntidad()'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>


			<?php echo $form->textFieldRow($model,'importe',array('class'=>'span1','title'=>'Ingrese items para que se modifique el importe',''=>'')); ?>
			<?php echo $form->textFieldRow($model,'interesDescuento',array('class'=>'span2')); ?>
			<div class="control-group success"><?php echo $form->textFieldRow($model,'importeFavor',array('class'=>'span1 success','onchange'=>'cambiaImporteCreditos()' )); ?></div>
			<?php echo $form->textAreaRow($model,'detalle',array('rows'=>2, 'cols'=>50, 'class'=>'span3')); ?>

	</div>
	<div class='span3'>
			<?php echo $form->listBoxRow($model,'estado',ParaCobrar::model()->getEstados(),array('class'=>'span3')); ?>


			

			<?php echo $form->listBoxRow($model,'idTipoComprobante',CHtml::listData(ComprobantesTipos::model()->findAll(), 'id', 'nombreTipoComprobante'),array('class'=>'span3')); ?>

			<?php echo $form->listBoxRow($model,'idTalonario',CHtml::listData(Talonarios::model()->findAll(), 'id', 'etiqueta'),array('class'=>'span3','onchange'=>'cambiaTalonario()')); ?>
			<?php echo $form->textFieldRow($model,'nroComprobante',array('class'=>'span2','maxlength'=>255)); ?>

	</div>
	<div class='span5'>

		<?=$this->renderPartial('_items',array('model'=>$model));?>
		<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
'id'=>'ventanaLiquidar',
'options'=>array(
    'title'=>"<img src='images/iconos/glyphicons/glyphicons_150_edit.png'/> FINALIZAR INGRESO <small class='muted'> Generar comprobante</small>",
    'autoOpen'=>false,
    'position'=>array('x'=>50,'y'=>50),
    'modal'=>true,
    'resizable'=>false,
    'close'=>'js:function(e,o){$(this).dialog("close");$(".btn").button("reset");}' ,
    'buttons' => array(
        array('text'=>'Cerrar','click'=> 'js:function(){$(this).dialog("close");$(".btn").button("reset");}'),
        array('text'=>'Aceptar','class'=>'btn btn-primary','click'=> 'js:function(){ingresarComprobante();}'),
    ),
),
));
?>

<?=$this->renderPartial('_finalizarComprobante',array('model'=>$model));?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
		
	</div>
</div>
</div>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'id'=>'btnAceptar',
			'type'=>'primary',
			'htmlOptions'=>array('onclick'=>'abreVentana()','data-loading-text'=>'Cargando...'),
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
<script>
init();

function init()
{
	$('#Comprobantes_importe').tooltip();
	cambiaTalonario();
	
	
}
function cambiaEntidad()
{
	buscarCreditos();
}
var importeCreditos=0;
function buscarCreditos()
{
	$.get( "index.php?r=entidades/buscaCreditos",{idEntidad:$('#Comprobantes_idEntidad').val()}, function( data ) {
		importeCreditos=data;
		$('#Comprobantes_importeFavor').val(data);
	});
}
function cambiaImporteCreditos()
{
	if($('#Comprobantes_importeFavor').val()*1 > importeCreditos){
		$('#Comprobantes_importeFavor').val(importeCreditos);
		alert('No puede ingresar un valor mayor a la disponibilidad de crédito!');
	}
}
function abreVentana()
{
	if(datosValidos())abrir();	
	$(".btn").button("reset");
}
function datosValidos()
{
	if($('#Comprobantes_idEntidad').val()==''){
		
		alert('Debe seleccionar una entidad!');
		setTimeout('$(".btn").button("reset")',200);
		$('#Comprobantes_idEntidad').focus();
		
		return false;
	}
	if($('#Comprobantes_importe').val()==''){
		alert('Debe seleccionar items!');
		setTimeout('$(".btn").button("reset")',200);
		$('#Comprobantes_idEntidad').focus();
		
		return false;
	}
	var importe=$('#Comprobantes_importe').val()*1 - $('#Comprobantes_interesDescuento').val()*1 - $('#Comprobantes_importeFavor').val()*1;
	if(importe<=0){
		alert('El importe final debe ser MAYOR que cero 0 ');
		setTimeout('$(".btn").button("reset")',200);
		
		return false;
	}
	return true;
}
function abrir()
{
	$("#ventanaLiquidar").dialog("open"); 
	$( "#ventanaLiquidar" ).dialog({
  		height:450,
  		width:500,
});
	$("#ventanaLiquidar").dialog('option', 'position', 'center');
	calcularFinal();
}
function cambiaTalonario()
{
	
	$.get( "index.php?r=talonarios/getProximoNro",{idTalonario:$('#Comprobantes_idTalonario').val()}, function( data ) {
	$('#Comprobantes_nroComprobante').val(data);
	});
}

</script>
