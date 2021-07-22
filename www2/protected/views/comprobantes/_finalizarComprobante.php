<script>

function calcularFinal()
{
	setEmailEntidad();
	tipoComprobante();
	$('#labelGuarda').hide();
	setPaga();
	setImportes();
}
function setImportes()
{
	var importe=$('#Comprobantes_importe').val()*1 + $('#Comprobantes_interesDescuento').val()*1 - $('#Comprobantes_importeFavor').val()*1;
	$('#importePago').val(importe.toFixed(2));
	$('#labelTotal').html("TOTAL $ "+importe.toFixed(2));
}
function setPaga()
{
	
}
function ingresarComprobante()
{
	$('#ventanaLiquidar').dialog("close");
	var mai=$('#enviaMail').attr('checked')?' y enviando mail <img src="images/iconos/glyphicons/glyphicons_010_envelope.png"/>.':'.';
	$.blockUI({ message: '<h3><img src="img/ajax_loader.gif" /> Espere un momento, ingresando comprobante '+mai+'</h3>' });
	$.getJSON( "index.php?r=comprobantes/ingresar",{items:items,credito:$('#Comprobantes_importeFavor').val(),email:$('#inputEmail').val(),imprimeCompro:$('#imprimeCompro').val(),guardarMail:$('#guardarMail').val(),enviaMail:$('#enviaMail').attr('checked'),importePago:$('#importePago').val(),idEntidad:$('#Comprobantes_idEntidad').val(),fecha:$('#Comprobantes_fecha').val(),importe:$('#Comprobantes_importe').val(),interesDescuentos:$('#Comprobantes_interesDescuento').val(),nroComprobante:$('#Comprobantes_nroComprobante').val(),estado:$('#Comprobantes_estado').val(),idTipoComprobante:$('#Comprobantes_idTipoComprobante').val(),idTalonario:$('#Comprobantes_idTalonario').val()}, function( data ) {
		$.unblockUI();
		rtaIngresa(data,$('#imprimeCompro').attr('checked'));
	}).fail(function() {
		$.unblockUI();
		alert('No se puede ingresar el comprobante: 1.- es probable que no tenga conexion a internet a los servidores AFIP. 2.- Este incorrecto el certificado electronico o vencido');
	});
}
function rtaIngresa(data,imprime)
{
	if(data.id!=null){
			if(imprime)imprimir(data.id);
			else {
				alert('Comprobante ingresado correctamente!');
				document.location.reload();
			}
		}else{
			alert('No se puede ingresar el comprobante!');
		};
	if(data.resElectronico.FeCabResp.Resultado=='R'){
			var tex='';
			tex+=data.resElectronico.Errors.Err.Msg;
			alert(tex);
		};
		
}
function imprimir(id)
{
	$.fancybox({
			'afterClose': function() {
            	window.location.reload();
            },
            'width': '600px',
            'height': '80%',
            'autoScale': true,
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'type': 'iframe',
            'href': 'index.php?r=Comprobantes/imprimir&id='+id,
            
        });
}
function cambiaImportePago()
{
	var final=($('#Comprobantes_importe').val()*1)+($('#Comprobantes_interesDescuento').val()*1)-($('#Comprobantes_importeFavor').val()*1);
	var dif=final-($('#importePago').val()*1);
	if(dif<0)
		$('#labelPaga').html('Quedarán $ '+(-dif).toFixed(2)+' a <span class="label label-success">cuenta</span>!');
	if(dif>0)
		$('#labelPaga').html('Quedarán $ '+dif.toFixed(2)+' <span class="label label-warning">a pagar</span>!');
	if(dif==0)
		$('#labelPaga').html('');
}
function cambiaMail()
{

	$('#labelGuarda').show();
}
function setEmailEntidad()
{
	$.getJSON( "index.php?r=entidades/getEntidad",{id:$('#Comprobantes_idEntidad').val()}, function( data ) {
	$('#inputEmail').val(data.email);
	if(data.email=='')$('#inputEmail').attr('placeholder','La entidad no tiene mail!');
	});
}
function tipoComprobante()
{
	$.get( "index.php?r=talonarios/esElectronico",{id:$('#Comprobantes_idTalonario').val()}, function( data ) {
	if(data==1)$('#textoComprobante').html('<p class="muted">Es un comprobante <span class="label label-info">Electronico</span>, esto implica que automaticamente se ingresará a AFIP...</p>');
		else $('#textoComprobante').html('<p class="muted">Es un comprobante normal...</p>');

	});

}
</script>
<div class='span4'>
<table>
	<tr  valign="top">
		<td><img src='images/iconos/glyphicons/glyphicons_227_usd.png'/> Paga </td>
		<td> 
			<input onchange='cambiaImportePago()' class='span2' type="text" id="importePago" placeholder="$ importe pesos"> 
	      	<div id='labelPaga'></div>
	    </td>
	</tr>
	
	<tr  valign="top">
		<td><img src='images/iconos/glyphicons/glyphicons_123_message_out.png'/> Email </td>
		<td> 
			<input onchange='cambiaMail()' type="text" id="inputEmail" placeholder="Email"> 
	      	<label class="checkbox"><input id='enviaMail' type="checkbox"> Enviar por mail?</label>
	      	<label id='labelGuarda' style='visible:none' class="checkbox"><input id='guardarMail' type="checkbox"> Guardar Nuevo email?</label>
	    </td>
	</tr>
	<tr valign="top">
		<td><img src='images/iconos/glyphicons/glyphicons_449_fax.png'/> Impresión</td>
		<td> 
			<div id='textoComprobante'></div>
	      	<label class="checkbox"><input id='imprimeCompro' type="checkbox"> Imprimir comprobante?</label>
	    </td>
	</tr>
	
</table>

<div style='padding:15px; float:right'>
<h3 id='labelTotal'></div>
</div>
</div>