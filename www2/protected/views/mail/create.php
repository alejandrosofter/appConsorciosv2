<?php
$this->breadcrumbs=array(
	'Mails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Mail', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Mail</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>