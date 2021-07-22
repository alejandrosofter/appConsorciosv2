<?php
$this->breadcrumbs=array(
	'Comprobantes Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar ComprobantesItems', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo ComprobantesItems</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>