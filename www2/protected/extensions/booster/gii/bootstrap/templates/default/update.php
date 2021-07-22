<?php
echo "<?php\n";
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Actualizar',
);\n";
?>

	$this->menu=array(
	array('label'=>'Ir a <?php echo $this->modelClass; ?>','url'=>array('index')),
	array('label'=>'Nuevo <?php echo $this->modelClass; ?>','url'=>array('create'))
	);
	?>

	<h1>Actualizar</h1>

<?php echo "<?php echo \$this->renderPartial('_form',array('model'=>\$model)); ?>"; ?>