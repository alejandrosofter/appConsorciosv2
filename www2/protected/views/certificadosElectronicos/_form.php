<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'certificados-electronicos-form','htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span3">
	<div class="">
		<?php echo $form->labelEx($model,'nombreCertificado',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreCertificado',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreCertificado'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'fechaCreacion',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fechaCreacion',
    'model'=>$model,
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
    	'class'=>'span2'
    ),
)); ?>
		<?php echo $form->error($model,'fechaCreacion'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'fechaExpira',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fechaExpira',
    'model'=>$model,
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
    	'class'=>'span2'
    ),
)); ?>
		<?php echo $form->error($model,'fechaExpira'); ?>
	</div>
</div>
<div class='span3'>
	<div class="">
		<?php echo $form->labelEx($model,'archivoCertificado',array('class'=>'')); ?>
		<?php echo $form->fileField($model,'archivoCertificado',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'archivoCertificado'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'archivoCsr',array('class'=>'')); ?>
		<?php echo $form->fileField($model,'archivoCsr',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'archivoCsr'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'archivoKey',array('class'=>'')); ?>
		<?php echo $form->fileField($model,'archivoKey',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'archivoKey'); ?>
	</div>
</div>
	



</div><!-- form -->
<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
	<?php $this->endWidget(); ?>