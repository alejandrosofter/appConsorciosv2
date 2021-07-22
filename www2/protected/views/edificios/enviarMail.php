<div class='row'>
<h1>ENVIAR MENSAJE MASIVO</h1>
	
		<textarea placeholder="TEXTO A ADJUNTAR AL MAIL" rows="5" id="mensaje" style="width: 100%"></textarea>
		<button onclick="enviarMail()" style="width: 100%" class="btn btn-success">ENVIAR MAIL</button> <br>
		<br>
		<table id='tablaMorosos' class="table  table-condensed" style="width: 100%">
 			<tr><th>Un.Funcional</th><th>Inquilino</th><th class='personal'>Tel.</th><th class='personal'>Email</th></tr>
 			<?php foreach($model->propiedades as $propiedad){?>
 				<tr class="filaData" id="fila_<?=$propiedad->id?>">
 					<td><?=$propiedad->nombrePropiedad?></td>
 					<td><?=$propiedad->inquilino->razonSocial?></td>
 				<td class='personal'><?=$propiedad->inquilino->telefono?></td>
 				<td class='personal'><?=$propiedad->inquilino->email?></td>
 				
 				</tr>
 			<?php }?>
		</table>
<script>
var propiedades=[];
<?php foreach($model->propiedades as $propiedad){?>
propiedades.push(<?=$propiedad->id?>);

<?php }?>
function enviarMail()
{
	
	var texto=$("#mensaje").val();
	for(var i=0;i<propiedades.length;i++)_enviaMail(propiedades[i],texto);
}
function _enviaMail(idPropiedad,texto)
{
	$("#fila_"+idPropiedad).attr("class","warning");
	$.get("index.php?r=mail/SendMailPropiedad",{idPropiedad:idPropiedad,mensaje:texto},function(err,res){
		$("#fila_"+idPropiedad).attr("class","success");
	})
}
</script>

	
</div>