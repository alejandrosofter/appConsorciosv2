<?php
$this->breadcrumbs=array(
	'Liquidaciones Para Cobrars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar LiquidacionesParaCobrar', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo LiquidacionesParaCobrar</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>