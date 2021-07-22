<?php $this->breadcrumbs = array(
	'Permisos'=>Rights::getBaseUrl(),
	Rights::t('core', 'Permisos'),
); ?>

<div id="permissions">

	<h2><?php echo Rights::t('core', 'Permisos'); ?></h2>

	<p>
		<?php echo Rights::t('core', 'Aca puedes ver y manejar los permisos para cada usuario.'); ?><br />
		<?php echo Rights::t('core', 'La autorizacion de los items pueden ser manejadas bajo {roleLink}, {taskLink} y {operationLink}.', array(
			'{roleLink}'=>CHtml::link(Rights::t('core', 'Roles'), array('authItem/roles')),
			'{taskLink}'=>CHtml::link(Rights::t('core', 'Tasks'), array('authItem/tasks')),
			'{operationLink}'=>CHtml::link(Rights::t('core', 'Operations'), array('authItem/operations')),
		)); ?>
	</p>

	<p><?php echo CHtml::link(Rights::t('core', 'Generar items para el control de las acciones'), array('authItem/generate'), array(
	   	'class'=>'generator-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}',
		'emptyText'=>Rights::t('core', 'No se encontraron autorizaciones.'),
		'htmlOptions'=>array('class'=>'grid-view permission-table'),
		'columns'=>$columns,
	)); ?>

	<p class="info">*) <?php echo Rights::t('core', 'Pase el ratón para ver de donde el permiso se hereda.'); ?></p>

	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Rights::t('core', 'Fuente'); ?>: '
		});

		/**
		* Hover functionality for rights' tables.
		*/
		$('#rights tbody tr').hover(function() {
			$(this).addClass('hover'); // On mouse over
		}, function() {
			$(this).removeClass('hover'); // On mouse out
		});

	</script>

</div>
