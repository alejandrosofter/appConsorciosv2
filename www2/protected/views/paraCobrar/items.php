<h3>Items</h3>
<table class='table table-condensed'>
<tr><th>Tipo Propiedad</th><th>Gasto</th><th>Coeficiente</th><th style='text-align:right'>Importe</th></tr>
<?foreach($items as $item){?>
<tr><td><?=$item->tipoPropiedad->nombreTipoPropiedad?></td><td><?=$item->tipoGasto->nombreTipoGasto?></td><td><?=$item->coeficiente?>%</td><td style='text-align:right'>$<?=number_format($item->importe,2)?></td></tr>
<?}?>
</table>