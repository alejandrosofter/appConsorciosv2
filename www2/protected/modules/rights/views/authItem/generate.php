<?php 
$this->breadcrumbs=array(
    'Usuarios'=>array('/usuarios'),
    'Generar Operaciónes'
);
 ?>

<div id="generator">

	<h2>Generar <span class='colored bolder'>Operaciónes</span></h2>

	<p><?php echo Rights::t('core', 'Seleccione las operaciones a controlar.'); ?></p>

	<div class="form">

		<?php $form=$this->beginWidget('CActiveForm'); ?>

			<div class="row">

				<table class="items generate-item-table" border="0" cellpadding="0" cellspacing="0">

					<tbody>

						<tr class="application-heading-row">
							<th colspan="3"><?php echo Rights::t('core', 'Application'); ?></th>
						</tr>

						<?php $this->renderPartial('_generateItems', array(
							'model'=>$model,
							'form'=>$form,
							'items'=>$items,
							'existingItems'=>$existingItems,
							'displayModuleHeadingRow'=>true,
							'basePathLength'=>strlen(Yii::app()->basePath),
						)); ?>

					</tbody>

				</table>

			</div>

			<div class="row">

   				<?php echo CHtml::link(Rights::t('core', 'Todos'), '#', array(
   					'onclick'=>"jQuery('.generate-item-table').find(':checkbox').attr('checked', 'checked'); return false;",
   					'class'=>'selectAllLink')); ?>
   				/
				<?php echo CHtml::link(Rights::t('core', 'Ninguno'), '#', array(
					'onclick'=>"jQuery('.generate-item-table').find(':checkbox').removeAttr('checked'); return false;",
					'class'=>'selectNoneLink')); ?>

			</div>

   			<div class="row">

				<?php echo CHtml::submitButton(Rights::t('core', 'Generar')); ?>

			</div>

		<?php $this->endWidget(); ?>

	</div>

</div>