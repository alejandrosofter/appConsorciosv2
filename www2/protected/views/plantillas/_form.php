<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'plantillas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	
	

	<?php echo $form->textFieldRow($model,'titulo',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($model,'clave',array('class'=>'span5','maxlength'=>11)); ?>
	<?php echo $form->ckEditorRow($model, 'texto', array());?>
<?php echo $form->textFieldRow($model,'tipo_salida',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Nuevo' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
