<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>


	<h3>
	<?=$form->textField($model,'buscar',array('class'=>'span3','placeholder'=>'Buscar por cualquier campo','size'=>80,'maxlength'=>255,'rel'=>'tooltip', 'title'=>'Puede buscar mediante cualquier campo de Edificios'));?>		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</h3>

<?php $this->endWidget(); ?>

<script>
$('#Edificios_buscar').tooltip();
</script>