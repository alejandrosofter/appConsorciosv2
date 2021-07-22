<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombreUsuario'); ?>
		<?php echo $form->textField($model,'nombreUsuario',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'clave'); ?>
		<?php echo $form->textField($model,'clave',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaAlta'); ?>
		<?php echo $form->textField($model,'fechaAlta',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imagen'); ?>
		<?php echo $form->textArea($model,'imagen',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'esAdministrativo'); ?>
		<?php echo $form->textField($model,'esAdministrativo',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idEstado'); ?>
		<?php echo $form->textField($model,'idEstado',array('class'=>'')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->