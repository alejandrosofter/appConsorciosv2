<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'propiedades-entidades-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->hiddenField($model,'idPropiedad',array('class'=>'')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fecha',
    'model'=>$model,
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
    	'class'=>'span2'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idEntidad',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idEntidad',CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('style'=>'width:250px','class'=>'chosen')); ?>
		<?php echo $form->error($model,'idEntidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoEntidadPropiedad',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idTipoEntidadPropiedad',CHtml::listData(PropiedadesEntidadesTipos::model()->findAll(), 'id', 'nombreEntidadTipo'),array ('style'=>'width:150px')); ?>
		<?php echo $form->error($model,'idTipoEntidadPropiedad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paga',array('class'=>'')); ?>
		<?php echo $form->checkbox($model,'paga',array('class'=>'')); ?>
		<?php echo $form->error($model,'paga'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
