<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'entidades-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'razonSocial')
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
<div class='span5'>
	<?php echo $form->textFieldRow($model,'razonSocial',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->select2Row($model,'idCondicionIva',array('data'=>CHtml::listData(CondicionesIva::model()->findAll(), 'id', 'nombreIva')),array('class'=>'span5')); ?>

	

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>
	<p class="text-warning">Para más de una <b>casilla</b> separe con ; (punto y comma)</p>
	<?php echo $form->select2Row($model,'idTipoEntidad',array('data'=>CHtml::listData(EntidadesTipos::model()->findAll(), 'id', 'nombreTipoEntidad')),array('class'=>'span5')); ?>
	<?php echo $form->textFieldRow($model,'importeFavor',array('class'=>'span2','maxlength'=>255)); ?>
</div>
<div class='span4'>
	
<?php echo $form->textFieldRow($model,'telefono',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($model,'cuit',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'domicilio',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($model,'provincia',array('class'=>'span3','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($model,'localidad',array('class'=>'span3','maxlength'=>255)); ?>
	<?php echo $form->textAreaRow($model,'detalle',array('rows'=>3, 'cols'=>50, 'class'=>'span4')); ?>

	
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
