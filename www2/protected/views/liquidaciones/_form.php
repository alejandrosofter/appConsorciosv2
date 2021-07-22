<script>
function cargarModal()
{
	$("#botonValores").fancybox({
    fitToView : true,
    width   : '100%',
    height    : '100%',
    autoSize  : false,
    afterClose :function(){cierraImportes()},
    openEffect  : 'none',
    closeEffect : 'none'
  });
}
function cierraImportes()
{
	$('#botonValores').button("reset");
	calcularTotal();
}
function calcularTotal()
{
	var sum=0;
	for(i=0;i<itemsImporteReserva.length;i++)sum+=itemsImporteReserva[i].importe*1;
	$('#Liquidaciones_importeFondoReserva').val(sum);
}
function cambiaImporteFondo()
{
	
	var valor=$('#Liquidaciones_importeFondoReserva').val();
	consultarItemsReserva();
}
function verValores()
{

}
function esValido()
{
	if($('#Liquidaciones_importe').val()==0){
		
		swal({   title: "Opss..",  text: 'El importe de la liquidacion debe ser mayor a CERO',html: true,  type: "error"},function(){$(".btn").button("reset")});
		return false;
	}
	if($('#Liquidaciones_fecha').val()==""){
		
		swal({   title: "Opss..",  text: 'Tiene que tener FECHA',html: true,  type: "error"},function(){$(".btn").button("reset")});
	return false;
	}
	if($('#Liquidaciones_idEdificio').val()==""){
		
		swal({   title: "Opss..",  text: 'Debe seleccionar un EDIFICIO',html: true,  type: "error"},function(){$(".btn").button("reset")});
	return false;
	}
	return true;
}
function cargar()
{
	if(esValido()){
		$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
		$.getJSON( "index.php?r=liquidaciones/cargar",{importeFondoReserva:$('#Liquidaciones_importeFondoReserva').val(),importe:$('#Liquidaciones_importe').val(),fechaVto:$('#Liquidaciones_fechaVto').val(),detalle:$('#Liquidaciones_detalle').val(),idEdificio:$('#Liquidaciones_idEdificio').val(),fecha:$('#Liquidaciones_fecha').val(),gastos:importes,fondoReserva:itemsImporteReserva}, function( data ) {
		 $.unblockUI(); 
		 if(data.error){
		 	swal({   title: "Opss..",  text: 'Ha ocurrido un error, por favor llamar al administrador del sistema.',html: true,  type: "error"},function(){$(".btn").button("reset")});
			
		 }else{
		 	window.location.href=("index.php?r=liquidaciones");
		 }
		 		$('#botonValores').button("reset");
		});
		 }
	
	
}
function cambiarValoresDefecto()
{
	$('.Departamento').val($('#importeDefectoDepto').val());
	$('.Departamento').each(function(index){
		cambiaValor($(this).attr("idpropiedad"));
	});
	$('.Cochera').val($('#importeDefectoCochera').val());
	$('.Cochera').each(function(index){
		cambiaValor($(this).attr("idpropiedad"));
	});
	$('.DepartamentoCochera').val($('#importeDefectoDeptoCochera').val());
	$('.DepartamentoCochera').each(function(index){
		cambiaValor($(this).attr("idpropiedad"));
	});
	setTimeout('$(".btn").button("reset");', 500);
	calcularTotal();
	
}
function consultarItemsReserva()
{
	$.getJSON( "index.php?r=propiedades/getImporteReserva",{idEdificio:$('#Liquidaciones_idEdificio').val()}, function( data ) {
		$("#contItems").html(data.data);
		});
}
function cambiaEdificio()
{
	if($("#Liquidaciones_idEdificio").val()!=""){
		consultarItemsReserva();
	consultarItems();
	}
	
}
function consultarItems()
{
	$.getJSON( "index.php?r=gastos/getParaLiquidar",{idEdificio:$('#Liquidaciones_idEdificio').val()}, function( data ) {
		$("#paraLiquidar").html(data.data);
		});
}
</script>
<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'liquidaciones-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
<div class='span12'>
	<div class='span3'>
			<?php echo $form->datepickerRow($model,'fecha',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'')); ?>

			<?php echo $form->select2row($model,'idEdificio',array(
				'data'=>CHtml::listData(Edificios::model()->findAll(), 'id', 'nombreEdificio'),
				'options'=>array('placeholder'=>'Seleccione...'),
				'htmlOptions'=>array('onchange'=>'cambiaEdificio()'))
			); 
			?>

			<?php echo $form->textAreaRow($model,'detalle',array('rows'=>5, 'cols'=>0, 'class'=>'span3')); ?>
	</div>
	<div class='span2'>
			<?php echo $form->datepickerRow($model,'fechaVto',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'')); ?>
			<span class="text-warning">Es la fecha que comenzara a contar el interes propuesto (en <a target="_BLANK" href="index.php?r=settings/variablesSistema">variables de sistema</a>).</span>
			<?php echo $form->textFieldRow($model,'importe',array('class'=>'span2')); ?>

			<?php echo $form->textFieldRow($model,'importeFondoReserva',array('class'=>'span1','onchange'=>'cambiaImporteFondo()')); ?>
			<a class='btn' href="#valores" style='' id='botonValores' onclick='verValores()'>Valores</a>
	
	</div>

<div id='paraLiquidar' class='span6'><i>No se ha seleccionado edificio</i></div>

</div>
</div>
<div class="form-actions">
<a class='btn btn-primary' onclick='cargar()'>Aceptar</a>
	
</div>
<div style="display:none" id="valores">
<h1>Importe a cada UNIDAD FUNCIONAL</h1>
<h4>Importes por defecto (luego puede cambiarlos manualmente por unidad)</h4>
$Deptos <input id="importeDefectoDepto" type="text" style="width:70px"/> $Cocheras <input id="importeDefectoCochera" type="text" style="width:70px"/>$Deptos/Cocheras <input type="text" style="width:70px" id="importeDefectoDeptoCochera"/> <a class="btn"  onclick="cambiarValoresDefecto()">Asignar Precios Por Defecto</a> 
<div id='contItems'></div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
cambiaEdificio();
cargarModal();
	
	
</script>