<?php
$this->breadcrumbs=array(
	'Liquidaciones'=>array('/liquidaciones'),
	'Para Cobrar',
);

?>

<header id="page-header">
<h1 id="page-title">Para Cobrar</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'liquidaciones-para-cobrar-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Fecha',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->paraCobrar->fecha)."</small>"',
            'htmlOptions'=>array('style'=>'width: 80px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Entidad',
            'value'=>'"<strong><big>".$data->paraCobrar->entidad->razonSocial."</big></strong>"',
            'htmlOptions'=>array('style'=>'width: 220px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Entidad',
            'value'=>'"".$data->paraCobrar->tipo->nombreParaCobrar.""',
            'htmlOptions'=>array('style'=>'width: 120px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".number_format($data->paraCobrar->importe,2)."</strong>"',
            'htmlOptions'=>array('style'=>'width: 70px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Estado',
            'value'=>'"<strong>".$data->paraCobrar->estado."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
