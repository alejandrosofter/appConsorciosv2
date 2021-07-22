<!DOCTYPE html>
<html lang="en">
    <head>

  <link rel="stylesheet" type="text/css" href="js/">
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Add fancyBox -->
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

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
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
<div class="container-fluid">


 <?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'PANEL DE CONTROL',
    'brandUrl'=>'',

    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>true,
            'items'=>array(
               
                
               
                //array('label'=>'Inicio','visible'=>Yii::app()->user->checkAccess("Usuarios.miInicio"),'url'=>'index.php?r=Usuarios/miInicio','icon'  => 'icon-home'),
               // array('label'=>'Cta Corriente','visible'=>Yii::app()->user->checkAccess("Gastos.Index"),'icon'  => 'icon-minus', 'url'=>'index.php?r=ParaCobrar/ctaCorriente'),
               // array('label'=>'Expensas Liquidadas','visible'=>Yii::app()->user->checkAccess("Liquidaciones.Index"),'icon'  => 'icon-list-alt', 'url'=>'index.php?r=ParaCobrar/ctaCorriente'),
             
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>isset(Yii::app()->user->nombre)?Yii::app()->user->nombre:'','icon'  => 'user white', 'url'=>'#', 'items'=>array(
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
		)); ?>
</div>
<div class='span11'>

<?php
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
    echo '<div class="flashes">';
    foreach($flashMessages as $key => $message) {
        echo '<div class="alert in fade alert-' . $key . '">' . $message . ' <a href="#" class="close" data-dismiss="alert">×</a></div>';
    }
    echo '</div>';
}

?>
</div>
<script>
$(".alert").animate({opacity: 1.0}, 4000).fadeOut("slow");
$('#barraSec').affix();

</script>
<div class="container">
<?=$content?>
</div>

<script>
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


</script>
<footer class="footer">
      <div class="container">
        <p>Diseño y programación desarrollado por <a href="http://softer.com.ar" target="_blank">SOFTER</a></p>
        <p>Cualquier duda o consulta por favor contactar a <a href="mailto:alejandro@softer.com.ar">info@softer.com.ar</a> o bien al 0297-4307553</p>
       
      </div>
    </footer>
</div>
</body>
</html>