<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="js/loaderAnim/nprogress.css">
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/loaderAnim/nprogress.js', CClientScript::POS_HEAD); ?>
  

  <link rel="stylesheet" type="text/css" href="js/">
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Add fancyBox -->
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
 <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="js/chosenv1/chosen.css" type="text/css" media="screen" />
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/chosenv1/chosen.jquery.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/webcam/jquery.webcam.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.3', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5', CClientScript::POS_HEAD); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/print.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timeago.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/block.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/printThis/printThis.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/diferenciaFechas.js', CClientScript::POS_BEGIN); ?>

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
 <script>NProgress.start();</script>
    </head>
    <body>
      <script>

      var start = Date.now();</script>
<div class="container-fluid">


 <?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand' => '<img src="img/logoChico.png"/>',
    'brandUrl'=>'index.php?r=site/usuario',

    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>true,
            'items'=>array(
               
                array('label'=>'Entidades', 'visible'=>Yii::app()->user->checkAccess("Archivos.Index"),'icon'  => 'icon-user', 'url'=>'#', 'items'=>array(                   
                    array('label'=>'Ver Entidades', 'visible'=>Yii::app()->user->checkAccess("Archivos.Index"), 'url'=>'index.php?r=entidades'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Archivos.Create"), 'url'=>'index.php?r=entidades/create'),
                )),
                    array('label'=>'Contratos', 'visible'=>Yii::app()->user->checkAccess("Contratos.Index"),'icon'  => 'icon-file', 'url'=>'#', 'items'=>array(                   
                    array('label'=>'Contratos','visible'=>Yii::app()->user->checkAccess("Contratos.Index"),'icon'  => 'icon-file', 'url'=>'#', 'items'=>array(
                    array('label'=>'Contratos','visible'=>Yii::app()->user->checkAccess("Contratos.Index"), 'url'=>'index.php?r=Contratos'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Contratos.Create"),  'url'=>'index.php?r=Contratos/create'),
               
                   
                   
                )),
                    array('label'=>'Estadisticas','visible'=>Yii::app()->user->checkAccess("Estadisticas.expensas"),'icon'  => 'icon-signal', 'url'=>'index.php?r=Estadisticas/contratos'), 
                )),
                 array('label'=>'Propiedades','visible'=>Yii::app()->user->checkAccess("ParaCobrar.Index"),'icon'  => 'icon-home', 'url'=>'#', 'items'=>array(
                    array('label'=>'Propiedades','visible'=>Yii::app()->user->checkAccess("Propiedades.Index"),'icon'  => 'icon-home', 'url'=>'#', 'items'=>array(
                    array('label'=>'Consultar','visible'=>Yii::app()->user->checkAccess("Propiedades.Index"), 'url'=>'index.php?r=Propiedades'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Propiedades.Create"),  'url'=>'index.php?r=Propiedades/create'),
               
                   
                   
                )),
                   
                     array('label'=>'Consultas','visible'=>Yii::app()->user->checkAccess("PropiedadesConsultas.Index"),'icon'  => 'icon-comment', 'url'=>'#', 'items'=>array(
                    array('label'=>'Consultas','visible'=>Yii::app()->user->checkAccess("PropiedadesConsultas.Index"), 'url'=>'index.php?r=PropiedadesConsultas'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("PropiedadesConsultas.Create"),  'url'=>'index.php?r=PropiedadesConsultas/create'),
               
                   
                   
                )),
                     array('label'=>'Edificios','visible'=>Yii::app()->user->checkAccess("Edificios.Index"),'icon'  => 'icon-th-large', 'url'=>'#', 'items'=>array(
                    array('label'=>'Edificios','visible'=>Yii::app()->user->checkAccess("Edificios.Index"), 'url'=>'index.php?r=Edificios'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Edificios.Create"),  'url'=>'index.php?r=Edificios/create'),
               
                   
                   
                )),
                     array('label'=>'Localidades','visible'=>Yii::app()->user->checkAccess("Localidades.Index"),'icon'  => 'icon-', 'url'=>'#', 'items'=>array(
                    array('label'=>'Localidades','visible'=>Yii::app()->user->checkAccess("Localidades.Index"), 'url'=>'index.php?r=Localidades'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Localidades.Create"),  'url'=>'index.php?r=Localidades/create'),
               
                   
                   
                )),
                      array('label'=>'Ubicaciones','visible'=>Yii::app()->user->checkAccess("Ubicaciones.Index"),'icon'  => 'icon-', 'url'=>'#', 'items'=>array(
                    array('label'=>'Ubicaciones','visible'=>Yii::app()->user->checkAccess("Ubicaciones.Index"), 'url'=>'index.php?r=Ubicaciones'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Ubicaciones.Create"),  'url'=>'index.php?r=Ubicaciones/create'),
               
                   
                   
                )),
                )),
               
                array('label'=>'Para Cobrar','visible'=>Yii::app()->user->checkAccess("ParaCobrar.Index"),'icon'  => 'icon-list-alt', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Para Cobrar','visible'=>Yii::app()->user->checkAccess("ParaCobrar.Index"), 'url'=>'index.php?r=ParaCobrar'),
                    array('label'=>'Agregar', 'visible'=>Yii::app()->user->checkAccess("ParaCobrar.Create"),'url'=>'index.php?r=ParaCobrar/create'),
                    '--',
                     array('label'=>'Liquidar Deuda','visible'=>Yii::app()->user->checkAccess("Comprobantes.LiquidarItems"),  'url'=>'index.php?r=Comprobantes/LiquidarItems'),
                )),
                array('label'=>'Expensas','visible'=>Yii::app()->user->checkAccess("Gastos.Index"),'icon'  => 'icon-minus', 'url'=>'#', 'items'=>array(
                  
                   array('label'=>'Gastos Frecuentes','visible'=>Yii::app()->user->checkAccess("edificiosGastosFrecuentes.Index"),'icon'  => 'icon-retweet', 'url'=>'#', 'items'=>array(
                    array('label'=>'Gastos Frecuentes','visible'=>Yii::app()->user->checkAccess("edificiosGastosFrecuentes.Index"), 'url'=>'index.php?r=edificiosGastosFrecuentes'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("edificiosGastosFrecuentes.Create"),  'url'=>'index.php?r=edificiosGastosFrecuentes/create'),
                    '---',
                     array('label'=>'Aplicar Gastos Frecuentes','visible'=>Yii::app()->user->checkAccess("edificiosGastosFrecuentes.aplicar"),  'url'=>'index.php?r=edificiosGastosFrecuentes/aplicar'),
                   
                   
                )),

                  
                     array('label'=>'Gastos','visible'=>Yii::app()->user->checkAccess("Gastos.Index"),'icon'  => 'icon-upload', 'url'=>'#', 'items'=>array(
                    array('label'=>'Gastos','visible'=>Yii::app()->user->checkAccess("Gastos.Index"), 'url'=>'index.php?r=Gastos'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Gastos.Create"),  'url'=>'index.php?r=Gastos/create'),
               
                   
                   
                )),
                     array('label'=>'Liquidaciones','visible'=>Yii::app()->user->checkAccess("Liquidaciones.Index"),'icon'  => 'icon-book', 'url'=>'#', 'items'=>array(
                    array('label'=>'Liquidaciones','visible'=>Yii::app()->user->checkAccess("Liquidaciones.Index"), 'url'=>'index.php?r=Liquidaciones'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Liquidaciones.Create"),  'url'=>'index.php?r=Liquidaciones/create'),
               
                   
                   
                )),
                   array('label'=>'Estadisticas','visible'=>Yii::app()->user->checkAccess("Estadisticas.expensas"),'icon'  => 'icon-signal', 'url'=>'index.php?r=Estadisticas/expensas'), 
                    array('label'=>'Aviso Pagos','visible'=>Yii::app()->user->checkAccess("Estadisticas.expensas"),'icon'  => '', 'url'=>'index.php?r=avisoPagos/'), 
                )),
                array('label'=>'Comprobantes','visible'=>Yii::app()->user->checkAccess("Comprobantes.Index"),'icon'  => 'icon-plus', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Comprobantes','visible'=>Yii::app()->user->checkAccess("Comprobantes.Index"), 'url'=>'index.php?r=Comprobantes'),
                    array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Comprobantes.Create"),  'url'=>'index.php?r=Comprobantes/create'),
                   
                 // '---',
                 // array('label'=>'Ver Pagos','visible'=>Yii::app()->user->checkAccess("Pagos.Index"), 'url'=>'index.php?r=Pagos'),
                 //  array('label'=>'Agregar','visible'=>Yii::app()->user->checkAccess("Pagos.Create"),  'url'=>'index.php?r=Pagos/create'),
                  '---',
                   array('label'=>'Tipos','visible'=>Yii::app()->user->checkAccess("ComprobantesTipos.Create"),  'url'=>'index.php?r=ComprobantesTipos'),
                )),
                 array('label'=>'','encodeLabel'=>true,'icon'  => 'arrow-down white', 'url'=>'#','activeCssClass'=>'icon-user', 'items'=>$this->menu),
            ),
        ),
      "<div id='loading' style='float:right;color:green;padding-top:10px;padding-left:30px'><img src='images/loader.gif'/></div>",
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>isset(Yii::app()->user->nombre)?Yii::app()->user->nombre:'','icon'  => 'user white', 'url'=>'#', 'items'=>array(
                   array('label'=>'Datos de Sistema','visible'=>Yii::app()->user->checkAccess("settings.variablesSistema"), 'url'=>'index.php?r=settings/variablesSistema'),
                    array('label'=>'Talonarios','visible'=>Yii::app()->user->checkAccess("talonarios.index"), 'url'=>'index.php?r=talonarios/index'),
                   
                    '-',
                    array('label'=>'Plantillas','visible'=>Yii::app()->user->checkAccess("plantillas.index"), 'url'=>'index.php?r=plantillas/'),
                    array('label'=>'Envio de Mails', 'visible'=>Yii::app()->user->checkAccess("mail"),'url'=>'index.php?r=mail'),
									'-',
                     array('label'=>'Usuarios', 'visible'=>Yii::app()->user->checkAccess("usuarios"),'url'=>'index.php?r=usuarios'),
									'-',
                    array('label'=>'Logout', 'icon'  => 'circle-arrow-left','url'=>'index.php?r=site/logout'),
                    //array('label'=>'Mis Datos','icon'  => 'user', 'url'=>'index.php?r=usuarios/update&id='.Yii::app()->user->id),
                )),
            ),
        ),
    ),
)); ?>
<div class='bread'>
<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
      'homeLink'=>CHtml::link('Home', array('site/usuario'))
		)); ?>
</div>

<?php
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
    echo '<div style="float:center">';
    foreach($flashMessages as $key => $message) {
        echo '<div class="alert in fade alert-' . $key . '">' . $message . ' <a href="#" class="close" data-dismiss="alert">×</a></div>';
    }
    echo '</div>';
}

?>
<script>
$(".alert").animate({opacity: 1.0}, 4000).fadeOut("slow");
$('#barraSec').affix();

</script>
<div class="container">
<?=$content?>
</div>

<script>
function imprimirPapel(debugFalg)
{
    $(".impresionPapel").printThis({
      debug: debugFalg,             
      importCSS: true,           
      printContainer: false,      
      pageTitle: "",             
      removeInline: false        
  });
}
  $('.btn').click(function () {
    $(this).button('loading');
});
$(".imprime").fancybox({
    fitToView : false,
    width   : '920px',
    height    : '100%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
$(".chico").fancybox({
    fitToView : false,
    width   : '400px',
    height    : '300px',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
$(".chosen").chosen();
$('#loading').html((Date.now() - start) + " ms");
NProgress.done();
</script>
<script src="js/sweetalert-master/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="js/sweetalert-master/dist/sweetalert.css">

<footer class="footer">
      <div class="container">
        <p>Diseño y programación desarrollado por <a href="http://softer.com.ar" target="_blank">SOFTER</a></p>
        <p>Cualquier duda o consulta por favor contactar a <a href="mailto:alejandro@softer.com.ar">info@softer.com.ar</a> o bien al 0297-4307553</p>
       
      </div>
    </footer>
</div>
</body>
</html>