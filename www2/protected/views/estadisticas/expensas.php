<h1><img src='images/iconos/glyphicons/glyphicons_079_signal.png'/> Estadisticas <small>de Expensas</small></h1>
<div class='row'>
	<div class='span2'>
		<ul id='grillaEdificios' class="nav nav-tabs nav-stacked">
		<?php foreach(Edificios::model()->findAll() as $edificio){?>
			<li id='ed_<?=$edificio->id?>'><a href="#" onclick='cambiaEdificio(<?=$edificio->id?>)'><?=$edificio->nombreEdificio?></a></li>
		<?php }?>
        </ul>
	</div>
	<div class='span10' id='resultados'>
		Centro de <strong>estadisticas de expensas</strong>. Por favor seleccione algún edificio del menu lateral para poder visualizar los datos. Los datos
		reflejados están asociados a la carga de LIQUIDACIONES, COBRO DE CUOTAS, PAGOS, GASTOS y COMPROBANTES.
	</div>
</div>
<script>
function cambiaEdificio(idEdificio)
{
	cambiaColor(idEdificio);
	$.get( "index.php?r=estadisticas/resultadoExpensas", {idEdificio:idEdificio}, function( data ) {
  		$('#resultados').html(data);
});

}
function cambiaColor(idEdificio)
{
	$('#grillaEdificios').children().attr('class','noactive');
	$('#ed_'+idEdificio).attr('class','active');
}
</script>