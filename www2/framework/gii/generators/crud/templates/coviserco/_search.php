<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>\n"; ?>

		<?php echo "<?php echo \$form->label(\$model,'buscar'); ?>\n"; ?>
		<?php echo "<?php echo \$form->textField(\$model,'buscar',array('class'=>'span5','size'=>80,'maxlength'=>255)); ?>\n"; ?>

		<?php echo "<?php echo CHtml::submitButton('Buscar',array('class'=>'btn btn-primary')); ?>\n"; ?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>