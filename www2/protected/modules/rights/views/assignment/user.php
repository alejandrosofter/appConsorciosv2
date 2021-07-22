<?php $this->breadcrumbs = array(
    'Usuarios'=>'index.php?r=usuarios',
	'Permisos Usuario',
); ?>

<div id="userAssignments">

	<h2><?php echo Rights::t('core', 'Asignaciones para <span class="colored bolder">:username</span>', array(
		':username'=>$model->getName()
	)); ?></h2>
	
	<div class="assignments span-12 first">

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'template'=>'{items}',
			'hideHeader'=>true,
			'emptyText'=>Rights::t('core', 'Este usuario no tiene asignaciones.'),
			'htmlOptions'=>array('class'=>'grid-view user-assignment-table mini'),
			'columns'=>array(
    			array(
    				'name'=>'name',
    				'header'=>Rights::t('core', 'Name'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'name-column'),
    				'value'=>'$data->getNameText()',
    			),
    			array(
    				'name'=>'type',
    				'header'=>Rights::t('core', 'Type'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'type-column'),
    				'value'=>'$data->getTypeText()',
    			),
    			array(
    				'header'=>'&nbsp;',
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'actions-column'),
    				'value'=>'$data->getRevokeAssignmentLink()',
    			),
			)
		)); ?>

	</div>

	<div class="add-assignment span-11 last">

		<h3><?php echo Rights::t('core', 'Asignar Item'); ?></h3>

		<?php if( $formModel!==null ): ?>

			<div class="form">

				<?php $this->renderPartial('_form', array(
					'model'=>$formModel,
					'itemnameSelectOptions'=>$assignSelectOptions,
				)); ?>

			</div>

		<?php else: ?>

			<p class="info"><?php echo Rights::t('core', 'No hay asignaciones disponibles para este usuario!'); ?>

		<?php endif; ?>

	</div>

</div>
