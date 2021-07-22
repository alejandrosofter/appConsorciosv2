	<div class='span3'>
			<?php echo $form->textFieldRow($model,'nombreEdificio',array('class'=>'span3','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'domicilio',array('class'=>'span2','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'telefono',array('class'=>'span3','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'nombrePortero',array('class'=>'span2','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>255)); ?>

			
	</div>
	<div class='span3'>
		
<?php echo $form->textFieldRow($model,'cuit',array('class'=>'span3','maxlength'=>255)); ?>
			<?php echo $form->textFieldRow($model,'razonSocialConsorcio',array('class'=>'span3','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'localidad',array('class'=>'span3','maxlength'=>255)); ?>

			<?php echo $form->textFieldRow($model,'provincia',array('class'=>'span2','maxlength'=>255)); ?>
			<?php echo $form->textFieldRow($model,'cp',array('class'=>'span1','maxlength'=>255)); ?>

	</div>
	<div class='span3'>
			
				<?php echo $form->select2Row($model,'idCondicionIva',array('data'=>CHtml::listData(CondicionesIva::model()->findAll(), 'id', 'nombreIva')),array('class'=>'span5')); ?>


			<?php echo $form->datepickerRow($model,'fechaInicio',array('options' => array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'')); ?>

			<?php echo $form->select2Row($model,'idTalonario',array('data'=>CHtml::listData(Talonarios::model()->findAll(), 'id', 'nombreTalonario')),array('class'=>'span5')); ?>

			<?php echo $form->textFieldRow($model,'importeFondoReserva',array('class'=>'span2')); ?>

		</div>
