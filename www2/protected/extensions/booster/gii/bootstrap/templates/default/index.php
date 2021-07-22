<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>

$this->menu=array(
array('label'=>'Nuevo <?php echo $this->modelClass; ?>','url'=>array('create')),
);
?>

<h1><?php echo $label; ?><small> </small>
<div style="float:right"><?= "<?php \$this->renderPartial('_search',array('model'=>\$dataProvider));?> \n"?></div></h1>
<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbJsonGridView',array(
'template'=>'{items} {pager}',
'type'=>'condensed',
'dataProvider'=>$dataProvider->search(),
'columns'=>array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if (++$count == 7) {
		echo "\t\t/*\n";
	}
	echo "array('name'=>'". $column->name ."', 'header'=>'". $column->name ."'), \n" ;
}
if ($count >= 7) {
	echo "\t\t*/\n";
}
?>
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{update} {delete}',


),
),
)); ?>
