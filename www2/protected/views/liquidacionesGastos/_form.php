<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'liquidaciones-gastos-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
	<div class='span5'>
			<?php echo $form->textFieldRow($model,'idLiquidacion',array('class'=>'span5')); ?>

			<?php echo $form->textFieldRow($model,'idGasto',array('class'=>'span5')); ?>

			<?php echo $form->textFieldRow($model,'importe',array('class'=>'span5')); ?>

		</div>
</div>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
