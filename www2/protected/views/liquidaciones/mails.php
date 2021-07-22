<script>
var arrItems= Array();

function enviarMail(idParaCobrar_,idLiquidacion_,gast,exp)
{
    $('#loader_'+idParaCobrar_).show();
    $.getJSON( "index.php?r=liquidaciones/enviaMail", {idParaCobrar:idParaCobrar_, idLiquidacion:idLiquidacion_,gastos:gast,expensas:exp,mensaje:$("#mensaje").val()}, function( data ) {
    console.log(data)
    if(!data.enviado.error)
        $('#res_'+idParaCobrar_).attr('class','text-success');
        else{
             $('#res_'+idParaCobrar_).attr('class','text-error');
        }
        $('#loader_'+idParaCobrar_).hide();
 });

}
function enviarIndividual(idParaCobrar_,idLiquidacion_)
{
    var item=getItem(idParaCobrar_);
    $('#loader_'+idParaCobrar_).show();
    var exp="<?=$gastos?>";
    var gast="<?=$expensas?>";
    $.getJSON( "index.php?r=liquidaciones/enviaMail", {idParaCobrar:idParaCobrar_, idLiquidacion:item.idLiquidacion,gastos:gast,expensas:exp,mensaje:$("#mensaje").val()}, function( data ) {
    
    if(!data.enviado.error)
        $('#res_'+idParaCobrar_).attr('class','text-success');
        else{
             $('#res_'+idParaCobrar_).attr('class','text-error');
        }
        $('#loader_'+idParaCobrar_).hide();
 });

}
function enviarTodos()
{
	 $('#boton').hide();
	var exp="<?=$gastos?>";
	var gast="<?=$expensas?>";
	for(i=0;i<arrItems.length;i++) enviarMail(arrItems[i].idParaCobrar,arrItems[i].idLiquidacion,gast,exp);
	 $('#boton').show();
}
function getItem(idParaCobrar)
{
    for(i=0;i<arrItems.length;i++)
        if(arrItems[i].idParaCobrar==idParaCobrar)return arrItems[i];
    return null;
}
function ingresa(paraCobrar,liquidacion)
{
	var item={idParaCobrar:paraCobrar,idLiquidacion:liquidacion};
	arrItems.push(item);
}
</script>
<div class='container'>
<h1><img src='images/iconos/glyphicons/glyphicons_010_envelope.png'></img> Envio de Mails <small> Inquilinos </small><a style="float:right;" id='boton' onclick="enviarTodos()" class='btn btn-primary'>ENVIAR A TODOS</a></h1>
<textarea placeholder="TEXTO A ADJUNTAR AL MAIL" rows="5" id="mensaje" style="width: 100%"></textarea>

<?php foreach($propietarios as $prop){
if($prop->paraCobrar->entidad->email!=''){?>
<p id='res_<?=$prop->idParaCobrar?>' class="">Enviar a <strong><?=$prop->paraCobrar->entidad->razonSocial?></strong> al correo <strong><?=$prop->paraCobrar->entidad->email?></strong>
    <a class="btn btn-success" onclick="enviarIndividual(<?=$prop->idParaCobrar?>)"><span class="icon-envelope icon-white" aria-hidden="true"></span></a>
<img style='display: none;' id='loader_<?=$prop->idParaCobrar?>' src='images/loader.gif'/>

<p>
<script>ingresa(<?=$prop->idParaCobrar?>,<?=$prop->idLiquidacion?>)</script>
<?php }else{?>
<p class="muted"><strong><?=$prop->paraCobrar->entidad->razonSocial?></strong> no tiene mail!</p>
<?php }
}
?>

<div id='res'></div>

</div>