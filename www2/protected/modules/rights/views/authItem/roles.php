<?php 

$this->breadcrumbs=array(
    'Usuarios'=>array('/usuarios'),
    'Roles'
);

?>
    <div style='float:right;'>
<? $this->widget('ext.cssmenu.CssMenu',array(
    'items'=>array(
        array('label'=>'Acciones <img src="images/iconos/famfam/star.png"/>',  'items'=>array(
            array('label'=>"<img src='images/iconos/famfam/add.png'/> Nuevo", 'url'=>array('/rights/authItem/create&type='.CAuthItem::TYPE_ROLE),'visible'=>Yii::app()->user->checkAccess("/rights/authItem/create")),
           
        )),
      
    ),
)); ?>
</div>
<div id="roles">

	<h1>Roles de <span class='colored bolder'>Usuarios</span></h1>
	<p>Un rol es un <span class='colored'>grupo de permisos</span> para realizar una variedad de tareas y operaciones, por ejemplo, el usuario autenticado.<br /></p>



	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Rights::t('core', 'No se encontraron Roles.'),
	    'htmlOptions'=>array('class'=>'grid-view role-table'),
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
    			'value'=>'$data->getDeleteRoleLink()',
    		),
	    )
	)); ?>

	<p class="info"><?php echo Rights::t('core', 'Los valores entre corchetes quiere decir cuántos hijos tiene cada elemento.'); ?></p>

</div>