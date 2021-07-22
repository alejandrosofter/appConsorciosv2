<?php
$this->breadcrumbs=array(
	'Mails',
);
$this->menu=array(
	array('label'=>'Nuevo Mail', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Mails</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mail-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'emisor',
		'receptor',
		'fecha',
		'estado',
		array(
'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width:120px'),
		'template'=>' {ver}',
            'buttons'=>array(
'ver' => array(
                'label'=>'Ver',
                 'imageUrl'=>'images/iconos/glyphicons/salida.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=mail/view&id=".$data->id',
            ),
                
            )


),
	),
)); ?>
