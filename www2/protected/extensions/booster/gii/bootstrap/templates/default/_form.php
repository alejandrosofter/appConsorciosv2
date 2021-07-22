<div class='row'>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
	<div class='span5'>
	<?php
	foreach ($this->tableSchema->columns as $column) {
		if ($column->autoIncrement) {
			continue;
		}
		?>
		<?php echo "<?php echo " . $this->generateActiveRow($this->modelClass, $column) . "; ?>\n"; ?>

	<?php
	}
	?>
	</div>
</div>
<div class="form-actions">
	<?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'htmlOptions'=>array('data-loading-text'=>'Cargando...'),
			'label'=>\$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>\n"; ?>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
