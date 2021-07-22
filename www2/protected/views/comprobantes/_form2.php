<div class="">
	<?php echo $form->errorSummary($model); ?>
<div class="span2">
<div class="">
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
	<div class="">
		<?php echo $form->labelEx($model,'fechaVencimiento',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fechaVencimiento',
    'model'=>$model,
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
    	'class'=>'span2'
    ),
)); ?>
		<?php echo $form->error($model,'fechaVencimiento'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'estado',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'estado',Comprobantes::model()->getEstados(),array ('style'=>'width:150px')); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	
	<div class="">
		<?php echo $form->labelEx($model,'nroComprobante',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nroComprobante',array('class'=>'span2','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nroComprobante'); ?>
	</div>


	<div class="">
		<?php echo $form->labelEx($model,'idTipoComprobante',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idTipoComprobante',CHtml::listData(ComprobantesTipos::model()->findAll(), 'id', 'nombreTipoComprobante'),array ('style'=>'width:150px')); ?>
		<?php echo $form->error($model,'idTipoComprobante'); ?>
	</div>
	

	
</div>
<div class="span4">
	
	<div class="">
		<?php echo $form->labelEx($model,'idEntidad',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idEntidad',CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('style'=>'width:250px','class'=>'chosen','prompt'=>'Seleccione...')); ?>
		<?php echo $form->error($model,'idEntidad'); ?>
	</div>

	
	<div class="">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>4, 'style'=>'width:280px')); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'span2')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
	

	
</div>


</div>
