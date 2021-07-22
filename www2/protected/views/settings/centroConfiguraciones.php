<?php
$this->breadcrumbs=array(
	'Configuraciones',
);

?>
<div id="columna_izquierda">
	<?php
	echo CHtml::image('images/iconos/financieros/config.png');
	?>
</div>
<div id="columna_derecha">
	<h1>CONFIGURACIONES</h1>
	<i> A continuación tiene a disposición el menú para ejectar funciones sobre configuraciones. Dentro de CONFIGURACIONES puede encontrar funciones de USUARIOS, IMPRESIONES, ACCIONES DISPONIBLES, ACTUALIZAR SISTEMA etc etc. </i><br><br>

</div>
<div id="abajo">
<?PHP

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
        'Usuarios'=>$this->renderPartial('/acciones/verAcciones',array('subTipo'=>'usuarios','tipo'=>'configuraciones','model'=>Acciones::model()),true),
        'Sistema'=>$this->renderPartial('/acciones/verAcciones',array('subTipo'=>'sistema','tipo'=>'configuraciones','model'=>Acciones::model()),true),
        'Impresiones'=>$this->renderPartial('/acciones/verAcciones',array('subTipo'=>'impresiones','tipo'=>'configuraciones','model'=>Acciones::model()),true),
        
     ),
    // additional javascript options for the accordion plugin
    'htmlOptions'=>array(
     'style'=>'height:280px;',
    //'height'=>500
      //  'collapsible'=>true,
    ),
));
?>
</div>
