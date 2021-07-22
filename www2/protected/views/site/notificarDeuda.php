<h2>HOLA <b><?=$entidad->razonSocial?></b>!</h2>
<p>Muchas gracias por confiar en nosotros. Por favor ingresa los datos requeridos para finalizar la <b>notificación del pago</b>!</p>
<style>
#AvisoPagos_image{
	color:green;
}
</style>
<div style="margin: 20px" class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'articulos-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
	<div class='span6'>
			<?php echo $form->textFieldRow($model,'importe',array('class'=>'span2','maxlength'=>255)); ?>
			<?php echo $form->hiddenField($model,'idEntidad',array('class'=>'span1','maxlength'=>255)); ?>
			<?php echo $form->hiddenField($model,'fechaAviso',array('class'=>'span1','maxlength'=>255)); ?>
			<?php echo $form->hiddenField($model,'estado',array('class'=>'span1','maxlength'=>255)); ?>
<br>
			<?php echo $form->fileField($model,'image'); ?>
			

		</div>
</div>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'htmlOptions'=>array('data-loading-text'=>'Cargando...'),
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
function ingresar()
{
	if(datosValidos())ingresa();
}
function ingresa()
{

}
function alerta(titulo,mensaje,tipo)
{
	Swal.fire({
	  title: titulo,
	  text: mensaje,
	  icon: tipo
	})
}
function datosValidos()
{
	if($("#importe").val()==""){
		alerta("Ops..","Por favor ingrese un IMPORTE y vuelva a intentar","error");
		return false;
	}
	if($("#titular").val()==""){
		alerta("Ops..","Por favor ingrese un TITULAR DE CUENTA y vuelva a intentar","error");
		return false;
	}
	if($("#fecha").val()==""){
		alerta("Ops..","Por favor ingrese una FECHA y vuelva a intentar","error");
		return false;
	}
	return true;

}
</script>