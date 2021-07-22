<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'propiedades-consultas-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
	<div class='span10'>
		<div class='span3'>
			<?php echo $form->datepickerRow($model,'fecha',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>


			<?php echo $form->textFieldRow($model,'solicitante',array('class'=>'span3','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'telefonos',array('class'=>'span3','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>255)); ?>

			<?php echo $form->textAreaRow($model,'observaciones',array('rows'=>6, 'cols'=>3, 'class'=>'span3')); ?>
		</div>
		<div class='span3'>
			<?php echo $form->listBoxRow($model,'estado',PropiedadesConsultas::model()->getEstados(),array ('style'=>'height:50px')); ?>
		

			<?php echo $form->listBoxRow($model,'tipoConsulta',PropiedadesConsultas::model()->getTipoConsultas(),array ('style'=>'height:50px')); ?>
		

			<?php echo $form->textFieldRow($model,'importeDesde',array('class'=>'span2')); ?>

			<?php echo $form->textFieldRow($model,'importeHasta',array('class'=>'span2')); ?>
			<?php echo $form->select2Row($model,'idTipoPropiedad',array('data'=>CHtml::listData(PropiedadesTipos::model()->findAll(), 'id', 'nombreTipoPropiedad'),'htmlOptions'=>array('onchange'=>'cambiaEntidad()'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>
			<?php echo $form->select2Row($model,'idUbicacion',array('data'=>CHtml::listData(Ubicaciones::model()->findAll(), 'id', 'nombreUbicacion'),'htmlOptions'=>array('onchange'=>'cambiaEntidad()'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>

		</div>
		<div class='span3'>
			<?php echo $form->textFieldRow($model,'cantidadHabitaciones',array('class'=>'span1')); ?>

			<?php echo $form->textFieldRow($model,'cantidadBanos',array('class'=>'span1')); ?>

			<?php echo $form->checkBoxRow($model,'tienePatio',array('class'=>'span1')); ?>

			<?php echo $form->checkBoxRow($model,'tieneQuincho',array('class'=>'span5')); ?>

			<?php echo $form->checkBoxRow($model,'publicaWeb',array('class'=>'span5')); ?>
		</div>
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
