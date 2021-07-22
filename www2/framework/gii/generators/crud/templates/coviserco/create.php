<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Create',
);\n";
?>

$this->menu=array(
	array('label'=>'Listar <?php echo $this->modelClass; ?>', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo <?php echo $this->modelClass; ?></h1>
</header>
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
