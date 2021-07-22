<?php $this->breadcrumbs = array(
	'Permisos'=>Rights::getBaseUrl(),
	Rights::t('core', 'Operaciones'),
); ?>

<div id="operations">

	<h2><?php echo Rights::t('core', 'Operaciones'); ?></h2>

	<p>
		<?php echo Rights::t('core', 'Una operación es un permiso para realizar una sola operación, por ejemplo, acceder a una acción de controlador determinado.'); ?><br />
		<?php echo Rights::t('core', 'Operaciones se encuentra más abajo en la jerarquía de las tareas de autorización y por lo tanto, sólo puede heredar de otras operaciones.'); ?>
	</p>

	<p><?php echo CHtml::link(Rights::t('core', 'Nueva Operacion'), array('authItem/create', 'type'=>CAuthItem::TYPE_OPERATION), array(
		'class'=>'add-operation-link',
	)); ?></p>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Rights::t('core', 'No se encontraron operaciones.'),
	    'htmlOptions'=>array('class'=>'grid-view operation-table sortable-table'),
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
    			'value'=>'$data->getDeleteOperationLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Rights::t('core', 'Los valores entre corchetes decir cuántos niños cada elemento tiene.'); ?></p>

</div>