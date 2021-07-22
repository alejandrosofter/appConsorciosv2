<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>


	<span>
	
	<?=$form->textField($model,'buscar',array('class'=>'span3','placeholder'=>'Buscar','maxlength'=>255,'rel'=>'tooltip', 'title'=>'Puede buscar mediante cualquier campo de Entidades'));?>		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</span>

<?php $this->endWidget(); ?>

<script>
$('#Entidades_buscar').tooltip();
</script>