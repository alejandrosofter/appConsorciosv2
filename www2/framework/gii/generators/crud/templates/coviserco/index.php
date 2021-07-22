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
	'$label',
);\n";

?>
$this->menu=array(
	array('label'=>'Nuevo <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>
</header>
<?="<?=\$this->renderPartial('_search',array('model'=>\$model));?>"?>
<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
