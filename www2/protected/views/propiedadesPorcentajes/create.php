<?php
$this->breadcrumbs=array(
	'Propiedades'=>array('/propiedades'),
	'Porcentajes '.$propiedad->nombrePropiedad=>array('/PropiedadesEntidades/index&id='.$model->idPropiedad),
	'Nuevo Porcentaje'
);

$this->menu=array(
	array('label'=>'Listar PropiedadesPorcentajes', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Agregar Porcentaje a <?=$propiedad->nombrePropiedad;?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>