<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>


	<span>
	<?=$form->textField($model,'buscar',array('class'=>'span3','placeholder'=>'Buscador','maxlength'=>255,'rel'=>'tooltip', 'title'=>'Puede buscar mediante cualquier campo de Articulos'));?>		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</span>

<?php $this->endWidget(); ?>

<script>
$('#Articulos_buscar').tooltip();
</script>