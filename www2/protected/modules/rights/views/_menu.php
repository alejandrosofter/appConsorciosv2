<?php $this->widget('zii.widgets.CMenu', array(
	'firstItemCssClass'=>'first',
	'lastItemCssClass'=>'last',
	'htmlOptions'=>array('class'=>'actions'),
	'items'=>array(
		array(
			'label'=>Rights::t('core', 'Asignaciones'),
			'url'=>array('assignment/view'),
			'itemOptions'=>array('class'=>'item-assignments'),
		),
		array(
			'label'=>Rights::t('core', 'Permisos'),
			'url'=>array('authItem/permissions'),
			'itemOptions'=>array('class'=>'item-permissions'),
		),
		array(
			'label'=>Rights::t('core', 'Roles'),
			'url'=>array('authItem/roles'),
			'itemOptions'=>array('class'=>'item-roles'),
		),
		array(
			'label'=>Rights::t('core', 'Tareas'),
			'url'=>array('authItem/tasks'),
			'itemOptions'=>array('class'=>'item-tasks'),
		),
		array(
			'label'=>Rights::t('core', 'Operaciones'),
			'url'=>array('authItem/operations'),
			'itemOptions'=>array('class'=>'item-operations'),
		),
	)
));	?>