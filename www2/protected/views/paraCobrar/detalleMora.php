<div class='impresionPapel'>
<h1><img src='images/iconos/glyphicons/glyphicons_034_old_man.png'/> <?=$entidad->razonSocial?>  <small><?=Date('d M Y')?></small></h1>
<table class='table table-condensed'>
<tr id='cols'><th>Propiedad</th><th>Detalle</th><th>Vto.</th><th>Importe</th><th>Saldo</th></tr>
<?php $sum=0;
foreach($model as $item){
$sum+=$item->importeSaldo;?>
<tr id='cols'><td><?=$item->propiedad->nombrePropiedad?></td><td><?=$item->detalle?></td><td><?=$item->fechaVencimiento?></td><td>$ <?=number_format($item->importe,2)?></td><th>$ <?=number_format($item->importeSaldo,2)?></th></tr>

<?php }?>
<tr id='cols'><th></th><th></th><th><big>TOTAL</big></th><th><big><?=number_format($sum,2)?></big></th></tr>
</table>
</div>
<a  style='float:right' onclick='imprimirPapel()' class="btn btn-primary" href="#"><i class="icon-print icon-white"></i> Imprimir</a>