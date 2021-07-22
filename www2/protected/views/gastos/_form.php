<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gastos-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
		<div class='span4'>
			<?php echo $form->select2row($model,'idEdificio',array('htmlOptions'=>array('onchange'=>'cambiarEdificio()'),'data'=>CHtml::listData(Edificios::model()->findAll(), 'id', 'nombreEdificio'),'options'=>array('placeholder'=>'Seleccione...','allowClear'=>true))); ?>

			<?php echo $form->listBoxRow($model,'idTipoGasto',CHtml::listData(GastosTipos::model()->findAll(), 'id', 'nombreTipoGasto'),array('onchange'=>'cambiaTipo()','class'=>'span2')); ?>
			<div id='fondoReserva'> 
			<?php echo $form->textFieldRow($model,'importeFondoReserva',array('class'=>'span2')); ?>

			<p class="text-warning">Este importe será debitado del fondo de reserva.</p>
			</div>
				<div id="PorcentajesValores_"><?=$this->renderPartial('gastosPorcentajes',array('porcentajes'=>$porcentajes,'valores'=>$valores,'idEdificio'=>$model->idEdificio));?></div>

			<div id='espe_'> Propiedades <br> 
			<select class="span2" placeholder="Propiedades" size="4" name="PropiedadesEspecificio[]" id="PropiedadesEspecificio"  multiple="multiple"></select></div>
			<?php echo $form->listBoxRow($model,'estado',$model->getEstados(),array('class'=>'span2')); ?>

			<input TYPE='hidden' name='Gastos[idComprobante]' value='<?=$model->idComprobante?>' id='Gastos_idComprobante'></input>

		</div>
		<div class="">
			<?=$this->renderPartial('/comprobantes/_form2',array('form'=>$form,'model'=>$modelComprobante));?>
		</div>
	
</div>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'htmlOptions'=>array('data-loading-text'=>'Cargando...'),
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
</div>
<script>
checkTipo();
cambiarEdificio();
setTimeout(setSeleccionEsp, 1000);

function setSeleccionEsp()
{
    $("#PropiedadesEspecificio").val(<?=$model->PropiedadesGastoString?>);

}
function cambiaTipo()
{
	checkTipo();
}
function cambiarEdificio()
{
	cargarPropiedades();
}
function checkTipo()
{
	var idTipo=$( "#Gastos_idTipoGasto option:selected" ).val();
	if(idTipo==1 || idTipo==2)$('#PorcentajesValores_').show("slow");else $('#PorcentajesValores_').hide("slow");
	if(idTipo==4)$('#espe_').show("slow");else $('#espe_').hide("slow");
}
function cargarPropiedades()
{
	$.get( "index.php?r=propiedades/getPropiedadesEspecifico",{idEdificio:$('#Gastos_idEdificio').val()} ,function( data ) {
		$('#PropiedadesEspecificio').html(data);
		
});
	
}
</script>
<?php $this->endWidget(); ?>
