<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'edificios-gastos-frecuentes-form',
	'focus'=>array($model,'detalle'),
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
		<div class='span5'>
			<?php echo $form->select2row($model,'idEdificio',array('data'=>CHtml::listData(Edificios::model()->findAll(), 'id', 'nombreEdificio'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>

			<?php echo $form->listBoxRow($model,'idTipoGasto',CHtml::listData(GastosTipos::model()->findAll(), 'id', 'nombreTipoGasto'),array('class'=>'span5')); ?>

			
			

			<?=$this->renderPartial('/gastos/gastosPorcentajes',array('porcentajes'=>$porcentajes,'valores'=>$valores,"idEdificio"=>$idEdificio));?>
		</div>
		<div class='span5'>
			<?php echo $form->select2row($model,'idEntidad',array('data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>

			<?php echo $form->textAreaRow($model,'detalle',array('rows'=>6, 'cols'=>20, 'class'=>'span5')); ?>
			<?php echo $form->textFieldRow($model,'importe',array('class'=>'span1')); ?>
			<?php echo $form->listBoxRow($model,'idTipoComprobante',CHtml::listData(ComprobantesTipos::model()->findAll(), 'id', 'nombreTipoComprobante'),array('class'=>'span5')); ?>
		</div>
		
</div>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'htmlOptions'=>array('data-loading-text'=>'Cargando...'),
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
