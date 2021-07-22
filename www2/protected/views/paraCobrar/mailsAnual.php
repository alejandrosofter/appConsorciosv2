<script>
var arrItems= Array();

function enviarMail(i)
{
	var id=arrItems[i];
	console.log(arrItems);
	console.log(id)
    $('#loader_'+id).show();
 	$.getJSON( "index.php?r=paraCobrar/enviaMail", {idPropiedad:id,mensaje:$("#mensaje").val()}, function( data ) {
		
    console.log(data)
		if(data)
    if(!data.error)
        $('#res_'+id).attr('class','text-success');
        else{
             $('#res_'+id).attr('class','text-error');
        }
        $('#loader_'+id).hide();
		if((i+1)<arrItems.length)enviarMail(i+1);
		if(arrItems[arrItems.length]==id)$('#boton').html("ENVIAR A TODOS");
 });

}
function enviarTodos()
{
	 $('#boton').html("AGUARDE...");
	enviarMail(0);
	 
}
	
</script>
<div class='container'>
<h1><img src='images/iconos/glyphicons/glyphicons_010_envelope.png'></img> Envio de Mails <small>a los porpietarios/inquilinos:</small></h1>
<a id='boton' onclick="enviarTodos()" class='btn btn-primary'>ENVIAR A TODOS</a>
<?php foreach($propiedades as $prop){
 $saldo=$prop->getDeudaRango($_GET['ano'],true);
//	$saldo=0;
if($saldo>0){
?>
<script>
arrItems.push(<?=$prop->id?>);
</script>
<p id='res_<?=$prop->id?>' class="">Enviar a <strong><?=isset($prop->inquilino)?$prop->inquilino->razonSocial:"-"?></strong> al correo <strong><?=isset($prop->inquilino)?$prop->inquilino->email:"-"?></strong>
<big><b style="color:red">$ <?=number_format($saldo)?></b></big>
<img style='display: none;' id='loader_<?=$prop->id?>' src='images/loader.gif'/>
</p>

<?php } }?>

<div id='res'></div>
<b>MENSAJE: </b><input type="textarea" id="mensaje" style="width:100%; " value="Por favor le pedimos que normalize la deuda. Atte. La Administracion" rows="3">
</div>