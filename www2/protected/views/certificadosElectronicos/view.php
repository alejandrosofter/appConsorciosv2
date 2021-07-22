<?php
$this->breadcrumbs=array(
	'Certificados Electronicoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CertificadosElectronicos', 'url'=>array('index')),
	array('label'=>'Create CertificadosElectronicos', 'url'=>array('create')),
	array('label'=>'Update CertificadosElectronicos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CertificadosElectronicos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CertificadosElectronicos', 'url'=>array('admin')),
);
?>

<h1>View CertificadosElectronicos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreCertificado',
		'fechaCreacion',
		'fechaExpira',
		'archivoCertificado',
		'archivoCsr',
		'archivoKey',
	),
)); ?>
