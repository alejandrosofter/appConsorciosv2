<div class="form span-12 first">

<?php if( $model->scenario==='update' ): ?>

	<h3><?php echo Rights::getAuthItemTypeName($model->type); ?></h3>

<?php endif; ?>
	
<?php $form=$this->beginWidget('CActiveForm'); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'Nombre del Rol'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength'=>255, 'class'=>'text')); ?>
		<?php echo $form->error($model, 'name'); ?>
		<p class="hint"><?php echo Rights::t('core', 'No cambie el nombre a menos que sepa lo que está haciendo.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'Descripción'); ?>
		<?php echo $form->textField($model, 'description', array('maxlength'=>255, 'class'=>'text')); ?>
		<?php echo $form->error($model, 'description'); ?>
		<p class="hint"><?php echo Rights::t('core', 'Un nombre descriptivo para este artículo.'); ?></p>
	</div>

	<?php if( Rights::module()->enableBizRule===true ): ?>

		<div class="row">
			<?php echo $form->labelEx($model, 'bizRule'); ?>
			<?php echo $form->textField($model, 'bizRule', array('maxlength'=>255, 'class'=>'text')); ?>
			<?php echo $form->error($model, 'bizRule'); ?>
			<p class="hint"><?php echo Rights::t('core', 'El código que se ejecutará cuando se realiza la comprobación de acceso.'); ?></p>
		</div>

	<?php endif; ?>

	<?php if( Rights::module()->enableBizRule===true && Rights::module()->enableBizRuleData ): ?>

		<div class="row">
			<?php echo $form->labelEx($model, 'data'); ?>
			<?php echo $form->textField($model, 'data', array('maxlength'=>255, 'class'=>'text')); ?>
			<?php echo $form->error($model, 'data'); ?>
			<p class="hint"><?php echo Rights::t('core', 'Datos adicionales disponibles cuando se ejecuta la regla de negocio.'); ?></p>
		</div>

	<?php endif; ?>
	

	<div class="actions">
		<?php echo CHtml::submitButton(Rights::t('core', 'Guardar'),array('class'=>'button big round blue')); ?> | <?php echo CHtml::link(Rights::t('core', 'Cancelar',array('class'=>'btn')), Yii::app()->user->rightsReturnUrl); ?>
	</div>

<?php $this->endWidget(); ?>

</div>