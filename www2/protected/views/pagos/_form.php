<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pagos-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
	<div class='span5'>
			<?php echo $form->select2Row($model,'idComprobante',array('data'=>CHtml::listData(Comprobantes::model()->findAll(), 'id', 'nombre'),'htmlOptions'=>array('onchange'=>''),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>

			<?php echo $form->datepickerRow($model,'fecha',array('options'=>array(),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>

			<?php echo $form->textFieldRow($model,'importe',array('class'=>'span2')); ?>

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
