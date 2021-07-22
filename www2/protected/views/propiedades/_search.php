<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>
<span style='font-size:15px'>
<table>
<tr>
	<td>
		<?php echo $form->select2row($model,'idEdificio',array('options'=>array('placeholder'=>'Seleccione...','allowClear'=>true),'data'=>CHtml::listData(Edificios::model()->findAll(), 'id', 'nombreEdificio')),array('class'=>'span5')); ?>

	</td>	<td>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</td>
</tr>
</table>
</span>
	
			

	

<?php $this->endWidget(); ?>

<script>
$('#Propiedades_buscar').tooltip();
</script>