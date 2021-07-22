<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'para-cobrar-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'detalle')
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
	<div class='span5'>
			<?php echo $form->textFieldRow($model,'detalle',array('class'=>'span5','maxlength'=>255)); ?>

			<?php echo $form->datepickerRow($model,'fecha',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>

		<?php echo $form->datepickerRow($model,'fechaVencimiento',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>

			<?php echo $form->select2Row($model,'idTipoParaCobrar',array('data'=>CHtml::listData(PropiedadesTipos::model()->findAll(), 'id', 'nombreTipoPropiedad')),array('class'=>'span5')); ?>

			
			<?php echo $form->select2Row($model,'idEntidad',array('data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>

			<div id='propiedadesEntidades'></div>
			<?php echo $form->select2Row($model,'idPropiedad',array('data'=>CHtml::listData(Propiedades::model()->findAll(), 'id', 'nombrePropiedad'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>
			

		</div>
	<div class='span5'>
			
<?php echo $form->textFieldRow($model,'punitorio',array('class'=>'span1','maxlength'=>255)); ?>
<p class="muted">El porcentaje que se aplicara pasada la fecha de vencimiento</p>
			<?php echo $form->listBoxRow($model,'estado',ParaCobrar::model()->getEstados(),array('class'=>'span5')); ?>


			<?php echo $form->textFieldRow($model,'importe',array('class'=>'span1','placeholder'=>'$ 00.00')); ?>

			<?php echo $form->textFieldRow($model,'importeSaldo',array('class'=>'span1','placeholder'=>'$ 00.00')); ?>
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

<script>
$( "#ParaCobrar_idEntidad" ).change(function() {
  cambiaEntidad();
});
function cambiaImporte()
{
	$('#ParaCobrar_importeSaldo').val($('#ParaCobrar_importe').val());
}
function cambiaEntidad()
{
	cargarPropiedades($('#ParaCobrar_idEntidad').val());
}
function cargarPropiedades(idEntidad)
{
	$.getJSON( "index.php?r=propiedadesEntidades/getPropiedades&idEntidad="+idEntidad, function( data ) {
		$('#propiedadesEntidades').html(data.data);
});
}
</script>