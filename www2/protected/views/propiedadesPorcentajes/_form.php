<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'propiedades-porcentajes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'porcentaje',array('class'=>'')); ?>
		<?php echo $form->textField($model,'porcentaje',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoPropiedad',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idTipoPropiedad',CHtml::listData(PropiedadesTipos::model()->findAll(), 'id', 'nombreTipoPropiedad'),array ('style'=>'width:150px')); ?>
		<?php echo $form->error($model,'idTipoPropiedad'); ?>
	</div>

		<?php echo $form->hiddenField($model,'idPropiedad',array('class'=>'')); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
