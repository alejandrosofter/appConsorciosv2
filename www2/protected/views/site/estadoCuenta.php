<div class='span3'>
<?php $saldo=Usuarios::model()->consultarServer('getSaldo');?>
<h3><img src='images/iconos/glyphicons/glyphicons_003_user.png'/> Estado <small>cuenta</small></h3>
<p>Estado de cuenta de <b><?=Usuarios::model()->consultarServer('getNombreCliente');?></b></p>

<big><big style='color:<?=$saldo<0?"red":"green"?>'>SALDO <b>$ <?=number_format($saldo,2)?></b></big></big>
<p><i><?=$saldo<0?"Vto.:":"" ?> <?=$saldo<0?Yii::app()->dateFormatter->format("dd/MM/yy",Usuarios::model()->consultarServer('getVencimiento')):"";?>
 </i></p>

<?=$saldo<0?$this->renderPartial('/usuarios/pagoSaldo',array('saldo'=>$saldo)):""?>

</div>