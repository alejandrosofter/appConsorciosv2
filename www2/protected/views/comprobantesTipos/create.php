<?php
$this->breadcrumbs=array(
	'Tipo de Comprobantes'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar ComprobantesTipos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Tipo</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>