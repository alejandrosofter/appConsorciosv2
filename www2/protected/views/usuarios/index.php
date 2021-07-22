<?php
$this->breadcrumbs=array(
	'Usuarios',
);

?>
<div >
<? $this->widget('ext.cssmenu.CssMenu',array(
    'items'=>array(
        array('label'=>'<img src="images/iconos/famfam/star.png"/>',  'items'=>array(
            array('label'=>"<img src='images/iconos/famfam/add.png'/> Nuevo", 'url'=>array('/usuarios/create/'),'visible'=>Yii::app()->user->checkAccess("usuarios.create")),
             array('label'=>"<img src='images/iconos/famfam/user.png'/> Roles", 'url'=>array('rights/authItem'),'visible'=>Yii::app()->user->checkAccess("rights")),
 )),
      
    ),
)); ?>
</div>
<header id="page-header">
<h1 id="page-title">Administración de Usuarios</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'nombreUsuario',
		'clave',
		'fechaAlta',
		'email',
		
		/*
		'esAdministrativo',
		'idEstado',
		*/
		array(
			'htmlOptions'=>array('style'=>'width:90'),
			'class'=>'CButtonColumn','template' => '{update} {delete}',
			'buttons'  => array(
            
            'update' => array(
                'visible'=>'Yii::app()->user->checkAccess("construcciones.update")'

            ),
            'delete' => array(
                'visible'=>'Yii::app()->user->checkAccess("construcciones.delete")'

            ),
         ),
		),
	),
)); ?>
