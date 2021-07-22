<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mail-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'emisor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'emisor',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'emisor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receptor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'receptor',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'receptor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mensaje',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'mensaje',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mensaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php echo $form->textField($model,'fecha',array('class'=>'')); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado',array('class'=>'')); ?>
		<?php echo $form->textField($model,'estado',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
