<?php $this->breadcrumbs = array(
    'Usuarios'=>'index.php?r=usuarios',
	Rights::t('core', 'Roles')=>'index.php?r=rights/authItem/roles',
	'Nuevo'
); ?>

<div class="createAuthItem">

	<h2><?php echo Rights::t('core', 'Nuevo :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></h2>

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

</div>