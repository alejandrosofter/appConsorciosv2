<h3>WEB</h3>
<div class="content-form">
<h4>Inicio</h4>
<p>Estado WEB</p>
 <?php echo  CHtml::dropDownList('WEB_HABILITADO',Settings::model()->getValorSistema('WEB_HABILITADO'),
 array('1'=>'Habilitado','0'=>'Desactivado'));?>
<p>Plantilla</p>
 <?php echo  CHtml::dropDownList('WEB_NOMBREPLANTILLA',Settings::model()->getValorSistema('WEB_NOMBREPLANTILLA'),
 array('thinker_template'=>'Template 1','arona_template'=>'Template 2'));?>
 <?php echo  CHtml::dropDownList('WEB_NOMBRECOLOR',Settings::model()->getValorSistema('WEB_NOMBRECOLOR'),
 array('style'=>'Azul','styleGreen'=>'Verde'));?>
<?php
$tabs=array(
     array('label' => 'Inicio', 'content' =>$this->renderPartial('_inicioWeb',array(),true)),
     array('label' => 'Imagen 1', 'content' => $this->renderPartial('_auxImagen',array('nombre'=>'Imagen 1','valor'=>'WEB_IMAGEN1'),true)),
     array('label' => 'Imagen 2', 'content' => $this->renderPartial('_auxImagen',array('nombre'=>'Imagen 2','valor'=>'WEB_IMAGEN2'),true)),
     array('label' => 'Imagen 3', 'content' => $this->renderPartial('_auxImagen',array('nombre'=>'Imagen 3','valor'=>'WEB_IMAGEN3'),true)),
     array('label' => 'Imagen 4', 'content' => $this->renderPartial('_auxImagen',array('nombre'=>'Imagen 4','valor'=>'WEB_IMAGEN4'),true)),
  
     array('label' => 'Quienes', 'content' => $this->renderPartial('_quienesWeb',array(),true)),
     array('label' => 'Servicios', 'content' =>$this->renderPartial('_serviciosWeb',array(),true)),
    

    );
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'pills',
        'tabs' => $tabs
    )
);
?>







</div>
<script>
function quitarImagen(nom)
{
    $.getJSON( "index.php?r=settings/quitarImagen", {nombre:nom},function( data ) {
        $('#'+nom).remove();
    });
}
</script>