<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'articulos-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
	<div class='span11'>
			<?php echo $form->textFieldRow($model,'nombreArticulo',array('class'=>'span4','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'posicion',array('class'=>'span2','maxlength'=>255)); ?>
			<?php echo $form->textFieldRow($model,'nroPosicion',array('class'=>'span1','maxlength'=>255)); ?>
			<?php $this->widget(
    'bootstrap.widgets.TbRedactorJs',
    array(
        'model' => $model,
        'attribute'=>'texto','htmlOptions'=>array('style'=>'width:100%;height:300px')
    )
); ?>

			<?php echo $form->datepickerRow($model,'fechaModificacion',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>


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
