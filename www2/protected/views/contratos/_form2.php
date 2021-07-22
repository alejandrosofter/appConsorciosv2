	<div style="width:230px" class='span1'>
			<?php echo $form->select2Row($model,'idDominio',array('data'=>CHtml::listData(Propiedades::model()->inmuebles(), 'id', 'nombrePropiedad'),'htmlOptions'=>array('onchange'=>''),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span5')); ?>


			<?php echo $form->select2Row($model,'idEntidadLocador',array('data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),'htmlOptions'=>array('onchange'=>''),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span6')); ?>

			<?php echo $form->select2Row($model,'idEntidadLocatario',array('data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),'htmlOptions'=>array('onchange'=>''),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span6')); ?>


			<?php echo $form->datepickerRow($model,'fechaInicio',array('options'=>array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>

			<?php echo $form->datepickerRow($model,'fechaVencimiento',array('options'=>array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2','onchange'=>'cambiaFecha()')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>
			
			
		</div>
		<div style="width:200px" class='span1'>
			
			<?php echo $form->select2Row($model,'idPlantilla',array('data'=>CHtml::listData(Plantillas::model()->findAll(), 'id', 'titulo'),'htmlOptions'=>array('class'=>'span2'),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span6')); ?>

			<?php echo $form->datepickerRow($model,'fechaRecesion',array('options'=>array('autoclose' => true,'format' => 'yyyy-mm-dd'),'htmlOptions'=>array('class'=>'span2')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'')); ?>

			<?php echo $form->textFieldRow($model,'depositoGarantia',array('class'=>'span1')); ?>

			<?php echo $form->textFieldRow($model,'periodicidad',array('class'=>'span1')); ?>
			<p class="muted">En formato numero, en meses</p>
			
			
				
		</div>
		<div class='span3'>
			<?php echo $form->select2Row($model,'idGarante1',array('data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),'htmlOptions'=>array('onchange'=>''),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span6')); ?>

			<?php echo $form->select2Row($model,'idGarante2',array('data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),'htmlOptions'=>array('onchange'=>''),'options'=>array('placeholder'=>'Seleccione...')),array('class'=>'span6')); ?>
			<?php echo $form->textFieldRow($model,'comisionAdministracion',array('class'=>'span1')); ?>
			<p class="muted">En formato porcentaje: ej 32% . O en formato importe:ej 530</p>	
			<?php echo $form->textFieldRow($model,'punitoriosDia',array('class'=>'span1')); ?>
			<p class="muted">En formato porcentaje: ej 32% . O en formato importe:ej 530</p>
		</div>
		<div class='span4'>
			<?php echo $form->textFieldRow($model,'cuota',array('class'=>'span1')); ?>
			<?=$this->renderPartial('importes',array('items'=>$items,'model'=>$model))?>
		</div>