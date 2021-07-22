<script src="js/aloha.min.js"></script>
<div >
<h1><?=$edificio->nombreEdificio?> <small><?=Date('d M Y')?></small></h1>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#morosos" aria-controls="home" role="tab" data-toggle="tab"><img src='images/iconos/glyphicons/glyphicons_007_user_remove.png'/> Morosos</a></li>
    <li role="presentation"><a href="#fondo" aria-controls="profile" role="tab" data-toggle="tab"><img src='images/iconos/glyphicons/glyphicons_227_usd.png'/> Fondo de Reserva</a></li>
    <li role="presentation"><a href="#anual" aria-controls="messages" role="tab" data-toggle="tab"> <div class="form-inline">
      Anual <input type="number" value="<?=Date('Y')?>" style="width:70px" id="ano"/>
			<button class="btn btn-success" onclick="buscarAnual(<?=$_GET['idEdificio']?>)"> BUSCAR </button>
      </div> </a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="morosos">
		<div class='impresionPapel'>


<div class='row'>

	<div class='span7'>
		<textarea placeholder="TEXTO A ADJUNTAR AL MAIL" rows="5" id="mensaje" style="width: 100%"></textarea>
		<table id='tablaMorosos' class="table  table-condensed" style="width: 100%">
 			<tr><th>Un.Funcional</th><th>Inquilino</th><th class='personal'>Tel.</th><th class='personal'>Email</th><th>Meses</th><th style='width:80px'>Importe</th></tr>
 			<?php foreach($morosos as $mora){?>
 				<tr>
 					<td><?=$mora->propiedad->nombrePropiedad?></td>
 					<td><a class="imprime" data-fancybox-type="iframe" title="Detalle" 
 				href="index.php?r=paraCobrar/detalleMora&idEntidad=<?=$mora->idEntidad;?>&idPropiedad=<?=$mora->idPropiedad;?>&idEdificio=<?=$mora->propiedad->idEdificio;?>">
 				<?=$mora->entidad->razonSocial?></a></td>
 				<td class='personal'><?=$mora->entidad->telefono?></td>
 				<td class='personal'><?=$mora->entidad->email?></td>
 				<td style='width:60px'><?=$mora->cantidadMeses;?></td>
 				<td style='width:80px'><small><small>$ <?=number_format($mora->importe,2)?></small></small></td>
 				<td><a class="btn btn-success" onclick="enviarMail(<?=$mora->entidad->id;?>)"><span class="icon-envelope icon-white" aria-hidden="true"></span></a></td>
 				</tr>
 			<?php }?>
		</table>
		 <div data-placement="left" data-original-title="Aquí escriba el contenido" id='detalle'><b>Detalle:</b> ...</div>
<div style='float:right'>
<input type="checkbox" id='checkPersonal' onclick="cambiaPersonal()" checked> Mostrar datos Personales


<a onclick='imprimirPapel()' style='width:800px' class="btn btn-primary" href="#"><i class="icon-print icon-white"></i> Imprimir</a>
</div>
	</div>
	
</div>
</div>
		</div>
    <div role="tabpanel" class="tab-pane" id="fondo">
			<div id='fondoReserva' class='span3'>
		<table class="table table-condensed">
 			<tr><th>A Recaudar <?=Date('Y')?></th><td>$ <?=number_format(Liquidaciones::model()->importeReserva($_GET['idEdificio'],Date('Y')),2);?></td></tr>
 			<tr><td>Gastado</td><td>$ <?=number_format(Gastos::model()->getImporteGastosFondoReserva($_GET['idEdificio'],Date('Y')),2);?></td></tr>
 			<tr><td>Recaudado</td><td>$ <?=number_format(ComprobantesItemsParaCobrar::model()->consultarImporteFondoCobrado($_GET['idEdificio'],Date('Y')),2);?></td></tr>
 			
 			     <tr><th>Año Pasado</th><td>$ <?=number_format(Liquidaciones::model()->importeReserva($_GET['idEdificio'],Date('Y')-1),2);?></td></tr>
 			<tr><td>Gastado</td><td>$ <?=number_format(Gastos::model()->getImporteGastosFondoReserva($_GET['idEdificio'],Date('Y')-1),2);?></td></tr>
 			<tr><td>Recaudado</td><td>$ <?=number_format(ComprobantesItemsParaCobrar::model()->consultarImporteFondoCobrado($_GET['idEdificio'],Date('Y')-1),2);?></td></tr>
		</table>
		
	</div>
		</div>
    <div role="tabpanel" style="" class="tab-pane" id="anual">
			
		  <div id="resultadoAno"> </div>
		</div>
  </div>

</div>


<script>
aloha(document.querySelector('#detalle'));
aloha(document.querySelector('#tablaMorosos'));
$('#detalle').tooltip();
function buscarAnual(idEdificio)
{
	$.blockUI({ message: '<h1> Aguarde un  momento...</h1>' });
	$.get("index.php?r=Estadisticas/buscarAnual",{ano:$("#ano").val(),idEdificio:idEdificio},function(res){
		$.unblockUI();
		$("#resultadoAno").html(res);
	})
}
function cambiaPersonal()
{
	if($('#checkPersonal').attr('checked')=='checked')$('.personal').show();
	else $('.personal').hide();
}
function enviarMail(id)
{
$.blockUI({ message: '<h1> Aguarde un  momento...</h1>' });
	$.getJSON("index.php?r=entidades/enviarDeuda",{idEntidad:id,mensaje:$("#mensaje").val()},function(res){
		$.unblockUI();
		console.log(res)
		if(res.error)swal("Ops..","No se puede enviar el mail: "+res.error,"error")
			else swal("Genial","Se ha enviado el mail!","success")
	})
}
function cambiaFondo()
{
	if($('#checkReserva').attr('checked')=='checked')$('#fondoReserva').show();
	else $('#fondoReserva').hide();
}
</script>