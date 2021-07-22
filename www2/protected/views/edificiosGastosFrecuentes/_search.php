<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>


	<span style='font-size:15px'>
	<?php echo $form->select2row($model,'idEdificio',array('data'=>CHtml::listData(Edificios::model()->findAll(), 'id', 'nombreEdificio')),array('prompt'=>'todos...')); ?>
	
	<?=$form->textField($model,'buscar',array('class'=>'span2','placeholder'=>'Detalle o entidad','maxlength'=>255,'rel'=>'tooltip', 'title'=>'Puede buscar mediante cualquier campo de EdificiosGastosFrecuentes'));?>		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	
	</span>

<?php $this->endWidget(); ?>

<script>
$('#EdificiosGastosFrecuentes_buscar').tooltip();
</script>