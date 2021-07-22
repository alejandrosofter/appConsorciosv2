<?php
$this->breadcrumbs=array(
	'Certificados Electronicos',
);
$this->menu=array(
	array('label'=>'Nuevo Certificado', 'url'=>array('create')),
);

?>

<header id="page-header">
<h1 id="page-title">Certificados Electronicos</h1>
</header><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'certificados-electronicos-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'nombreCertificado',
		'fechaCreacion',
		'fechaExpira',
		array(
            'type'=>'html',
            'header'=>'Certificado',
            'value'=>'Chtml::link($data->archivoCertificado,"certificadosElectronicos/".$data->archivoCertificado)',
            'htmlOptions'=>array('style'=>'width: 130px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Csr',
            'value'=>'Chtml::link($data->archivoCsr,"certificadosElectronicos/".$data->archivoCsr)',
            'htmlOptions'=>array('style'=>'width: 130px'),
            ),
		
		array(
            'type'=>'html',
            'header'=>'Key',
            'value'=>'Chtml::link($data->archivoKey,"certificadosElectronicos/".$data->archivoKey)',
            'htmlOptions'=>array('style'=>'width: 130px'),
            ),
		
		array(
			'class'=>'CButtonColumn','template'=>'{check} {update} {delete}','htmlOptions'=>array('style'=>'width:90px'),
			'buttons'=>array(
				
			'check' => array(
                'label'=>'Check',
                'imageUrl'=>'images/iconos/famfam/arrow_rotate_clockwise.png',
                'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
                'url' => '"index.php?r=certificadosElectronicos/check&id=".$data->id',
            ),
		)),
	),
)); ?>


<a class="btn btn-primary" href='index.php?r=certificadosElectronicos/downPK' >Descargar Key</a>

<a class="btn btn-primary" href='index.php?r=certificadosElectronicos/downCSR' >Descargar Pedido AFIP</a>