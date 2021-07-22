<?php
$this->breadcrumbs=array(
	'Certificados Electronicos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar CertificadosElectronicos', 'url'=>array('index')),
	array('label'=>'Nuevo CertificadosElectronicos', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>