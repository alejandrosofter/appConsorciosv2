<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>\n"; ?>


	<span>
	<?= "<?=\$form->textField(\$model,'buscar',array('class'=>'span3','placeholder'=>'Buscador','maxlength'=>255,'rel'=>'tooltip', 'title'=>'Puede buscar mediante cualquier campo de ".$this->modelClass."'));?>" ?>
		<?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>\n"; ?>
	</span>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

<?= "<script>
$('#".$this->modelClass."_buscar').tooltip();
</script>";?>