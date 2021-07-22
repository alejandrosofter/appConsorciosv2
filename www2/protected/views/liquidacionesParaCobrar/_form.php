<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'liquidaciones-para-cobrar-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idLiquidacion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idLiquidacion',array('class'=>'')); ?>
		<?php echo $form->error($model,'idLiquidacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idParaCobrar',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idParaCobrar',array('class'=>'')); ?>
		<?php echo $form->error($model,'idParaCobrar'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
