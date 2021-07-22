<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>


	<h3>
	<?=$form->textField($model,'buscar',array('class'=>'span3','placeholder'=>'Buscar por Entidad o ','maxlength'=>255,'rel'=>'tooltip', 'title'=>'Puede buscar mediante cualquier campo de ParaCobrar'));?>		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</h3>

<?php $this->endWidget(); ?>

<script>
$('#ParaCobrar_buscar').tooltip();
</script>