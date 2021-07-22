<?php
$this->breadcrumbs=array(
	'Certificados Electronicos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar CertificadosElectronicos', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Certificado</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>