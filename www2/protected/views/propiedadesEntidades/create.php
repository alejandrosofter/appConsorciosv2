<?php
$this->breadcrumbs=array(
	'Propiedades'=>array('/propiedades'),
	'Entidades '.$propiedad->nombrePropiedad=>array('/PropiedadesEntidades/index&id='.$model->idPropiedad),
	'Nueva Entidad'
);

$this->menu=array(
	array('label'=>'Listar PropiedadesEntidades', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Agregar Entidad a <?=$propiedad->nombrePropiedad;?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>