<?php $this->breadcrumbs = array(
	'Permisos'=>Rights::getBaseUrl(),
	Rights::t('core', 'Tareas'),
); ?>

<div id="tasks">

	<h2><?php echo Rights::t('core', 'Tareas'); ?></h2>

	<p>
		<?php echo Rights::t('core', 'Una tarea es un permiso para realizar operaciones múltiples, por ejemplo, acceso a un grupo de acción del controlador.'); ?><br />
		<?php echo Rights::t('core', 'Las tareas se encuentra más abajo en la jerarquía de las funciones de autorización y por lo tanto, sólo puede heredar de otras tareas y / o operaciones.'); ?>
	</p>

	<p><?php echo CHtml::link(Rights::t('core', 'Nueva Tarea'), array('authItem/create', 'type'=>CAuthItem::TYPE_TASK), array(
		'class'=>'add-task-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Rights::t('core', 'No se encontraron Tareas.'),
	    'htmlOptions'=>array('class'=>'grid-view task-table'),
	    'columns'=>array(
    		array(
    			'name'=>'name',
    			'header'=>Rights::t('core', 'Nombre'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->getGridNameLink()',
    		),
    		array(
    			'name'=>'description',
    			'header'=>Rights::t('core', 'Descripcion'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'description-column'),
    		),
    		array(
    			'name'=>'bizRule',
    			'header'=>Rights::t('core', 'Regla de Negocio'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'bizrule-column'),
    			'visible'=>Rights::module()->enableBizRule===true,
    		),
    		array(
    			'name'=>'data',
    			'header'=>Rights::t('core', 'Data'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'data-column'),
    			'visible'=>Rights::module()->enableBizRuleData===true,
    		),
    		array(
    			'header'=>'&nbsp;',
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'actions-column'),
    			'value'=>'$data->getDeleteTaskLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Rights::t('core', 'Los valores entre corchetes quiere decir cuántos hijos tiene cada elemento.'); ?></p>

</div>