<h1><img src='images/iconos/glyphicons/glyphicons_079_signal.png'/> Estadisticas <small>de Contratos</small></h1>
<div class='row'>
	<div class='span10' id='resultados'>
		<table class="table table-hover">
 			<tr><th>Propiedad</th><th>Locador</th><th>Locatario</th><th>Tel.</th><th>SALDO</th></tr>
		<?php foreach($items as $item){?>
			<tr><td><?=$item->inmueble->nombrePropiedad?></td><td><?=$item->locador->razonSocial?></td><td><?=$item->locatario->razonSocial?></td><td style='width:80px'><?=$item->locatario->telefono?></th>
				<?php foreach($item->paraCobrar as $pc)
					if($pc->paraCobrar->vencido() && !$pc->paraCobrar->saldado() ) {?>
				<td><small><?=Yii::app()->dateFormatter->format("MM/yy",$pc->paraCobrar->fechaVencimiento)?> <small style='color:red'>$<?=number_format($pc->paraCobrar->importeSaldo,2)?></small></small></td>
				<?php }?>
			</tr>
		<?php }?>
		</table>
	</div>
</div>
<script>

</script>