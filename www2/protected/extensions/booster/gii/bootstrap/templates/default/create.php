<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Nuevo',
);\n";
?>

$this->menu=array(
array('label'=>'Ir a <?php echo $this->modelClass; ?>','url'=>array('index')),
);
?>

<h1>Nuevo <?php echo $this->modelClass; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
