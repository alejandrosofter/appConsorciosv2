<div style='padding:8px' class='<?=$model->hasErrors("cantidadImportes")?"alert-error":""?>'>

<table class="table table-bordered">
	<tr><td>
<h3><img src="images/pago.png"/> Importes  <span class="required">*</span><small></small></h3>

<table id='tablaPagos' class="table table-condensed">
<tr><th>Desde Cuota</th><th>Hasta Cuota</th><th>Importe</th></tr>

</table>
</tr></td>
<tr><td>
<input style="font-size:11px;width:40px" placeholder="Desde" id="desdeCuota" name="desdeCuota" type="text"></input>
<input style="font-size:11px;width:40px" placeholder="Hasta" id="hastaCuota" name="hastaCuota" type="text"></input>
<input style="font-size:11px;width:60px" placeholder="Importe" id="importePago" name="importePago" type="text"></input>
<a class="" title='Agregar' id='botonAgrega' onclick='agregarPago()' href="#"><i class="icon-plus "></i></a>

</tr></td>
</table>
 <script>
 var pagos = new Array();
   $('.escucha').keypress(function(e) {
    if(e.which == 13) {
        agregarPago()
    }
});
  $('#importePago').keypress(function(e) {
    if(e.which == 13) {
        agregarPago()
    }
});
  function IsNumeric(input)
	{
	    return (input - 0) == input && (''+input).replace(/^\s+|\s+$/g, "").length > 0;
	}
  function esValido(pago)
  {
  	var salida;
  	salida=checkTipos();
  	salida=salida&&cuotas(pago);
  	return salida;
  }
  
  
  function cuotas(pago)
  {

  	if(pagos.length==0){
  		console.log(parseInt($('#Contratos_cuota').val()));
  		if(pago.hastaCuota>parseInt($('#Contratos_cuota').val())){alert('El valor HASTA CUOTAS NO puede ser mayor a la cantidad de cuotas!');return false};

  		if(pago.desdeCuota<=0){alert('No se puede arrancar de la cuota 0!');return false;}
  		if(pago.desdeCuota>1){alert('La primera cuota debe ser 1!');return false;}
  		if(pago.desdeCuota>pago.hastaCuota){alert('La CUOTA DESDE no puede ser mayor a la CUOTA HASTA!');return false;}

  	}else{
  		var  ultimo=pagos[(pagos.length-1)];
  		if(pago.hastaCuota>parseInt($('#Contratos_cuota').val())){alert('El valor HASTA CUOTAS NO puede ser mayor a la cantidad de cuotas!');return false};
  		if(pago.desdeCuota!=(parseInt(ultimo.hastaCuota)+1)){alert('El proximo valor del campo DESDE CUOTA debe ser '+String(parseInt(ultimo.hastaCuota)+1));return false};

  		if(pago.desdeCuota<=ultimo.hastaCuota){alert('El valor DESDE CUOTA no puede ser menor o igual al valor HASTA CUOTA del  ultimo item cargado!');return false;}
  		console.log(pago.desdeCuota);console.log(pago.hastaCuota);
      if(pago.desdeCuota>pago.hastaCuota){alert('La CUOTA DESDE no puede ser mayor a la CUOTA HASTA!');return false;}
  	}
  	return true;
  }
  function checkTipos()
  {
  	if(!IsNumeric(parseInt($('#desdeCuota').val()))){alert('Debe ingresar valores enteros!');return false;}
  	if(!IsNumeric(parseInt($('#importePago').val()))){alert('Debe ingresar valores enteros!');return false;}
  	if(!IsNumeric(parseInt($('#hastaCuota').val()))){alert('Debe ingresar valores enteros!');return false;}
  	return true;
  }
 function agregarPago()
 {
 	
 		var pago={id:parseInt(pagos.length),desdeCuota:parseInt($('#desdeCuota').val()),hastaCuota:parseInt($('#hastaCuota').val()),importe:$('#importePago').val() };
 	if(esValido(pago))	agregarItemPago(pago);
 	
 	
 }
 function agregarItemPago(pago)
{
      pagos.push(pago);
      var aux=parseInt($('#hastaCuota').val())+1;
      aux=aux>0?aux:"";
      $('#desdeCuota').val(aux);
      $('#hastaCuota').val('');
      $('#importePago').val('');
      $('#hastaCuota').focus();
      $('#tablaPagos tr:last').after('<tr id="fila_'+pago.id+'"><td> <input style="font-size:11px;width:40px" placeholder="Desde" id="importes['+pago.id+'][desdeCuota]" name="importes['+pago.id+'][desdeCuota]" value="'+pago.desdeCuota+'" type="text"/><input TYPE="hidden" id="importes['+pago.id+'][id]" name="importes['+pago.id+'][id]" value="'+pago.id+'"/></td><td><input style="font-size:11px;width:40px" placeholder="Desde" id="importes['+pago.id+'][hastaCuota]" name="importes['+pago.id+'][hastaCuota]" value="'+pago.hastaCuota+'" type="text"/></td><td><input style="font-size:11px;width:60px" placeholder="Desde" id="importes['+pago.id+'][importe]" name="importes['+pago.id+'][importe]" value="'+pago.importe+'" type="text"/></td><td><a href="#" onclick="quitarPagoaHoy('+pago.id+')"><img src="images/iconos/famfam/cancel.png"/></a></td></tr>');

}
function quitarPagoaHoy(idPago)
{
      $('#fila_'+idPago).remove();
      quitarPago(idPago);
}
function quitarPago(idPago)
{
      for (var i = 0; i < pagos.length; i++)
            if(pagos[i].id==idPago)
                  pagos.splice( i, 1 );
}
</script>
<?php
foreach($items as $item){

echo "<script>var aux={id:".$item->id.",desdeCuota:'".$item->desdeCuota."',hastaCuota:'".$item->hastaCuota."',importe:'".$item->importe."'};
agregarItemPago(aux);
</script>";
}
?>
</div>