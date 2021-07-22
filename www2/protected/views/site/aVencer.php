<small>
<table class='table table-condensed'>
<tr><th>Ref.</th><th>Tipo</th><th>Vence</th><th>Detalle</th><th>Importe</th></tr>
<?php
$sql='';
if($muestraContratos){
$sql.="(select datediff(now(),fechaVencimiento) as dias,contratos.fechaVencimiento as fechaVencimiento,'Contratos' as tipo,contratos.id as ref,'variable' as importe, concat('Contrato de ',entidades.razonSocial) as detalle from contratos left join entidades on idEntidadLocador = entidades.id where contratos.estado='ACTIVO' AND datediff(now(),fechaVencimiento) BETWEEN $desde and $hasta)";
}
if($muestraDeudas){
	if($muestraContratos) $sql.=" UNION ";
$sql.="(select datediff(now(),fechaVencimiento) as dias,paraCobrar.fechaVencimiento as fechaVencimiento,'Deudas' as tipo,paraCobrar.id as ref,paraCobrar.importe as importe, concat(paraCobrar.detalle,'-',entidades.razonSocial) as detalle from paraCobrar left join entidades on idEntidad = entidades.id where paraCobrar.estado='PENDIENTE' AND  datediff(now(),fechaVencimiento) BETWEEN $desde and $hasta)";	
}
if($muestraComprobantes){
	if($muestraContratos || $muestraDeudas) $sql.=" UNION ";
$sql.="(select datediff(now(),fechaVencimiento) as dias,comprobantes.fechaVencimiento as fechaVencimiento,'Compr.' as tipo,comprobantes.id as ref,comprobantes.importe as importe, concat(entidades.razonSocial) as detalle from comprobantes left join entidades on idEntidad = entidades.id where comprobantes.estado='PENDIENTE' AND  datediff(now(),fechaVencimiento) BETWEEN $desde and $hasta)";	
}

if(!$muestraContratos&&!$muestraDeudas&&!$muestraComprobantes)return;
$sql.=' ORDER BY dias asc,ref desc';
$data= Yii::app()->db->createCommand($sql)->queryAll();

foreach($data as $item){
?>
<tr class='<?=$item["dias"]>0?"error":""?>'>
<td><?=$item['ref'];?></td>
<td><?=$item['tipo'];?></td>
<td title='<?=Yii::app()->dateFormatter->format("dd/MM/yy",$item['fechaVencimiento']);?>'><?=$item['dias'];?> d.</td>
<td><?=$item['detalle'];?></td>
<td><?=$item['importe']=='variable'?'variable':number_format($item['importe'],2);?></td>
</tr>

<?php } ?>
</table>

</small>