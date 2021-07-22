`.<div class=''>
	<div id='itemsParaLiquidar'>
		<i>No hay items para liquidar</i>
	</div>
	<div style="float:right">
		<h4 style='color:red' id='labInteres'>Interés $ 0.00</h4>
		<h4 style='color:green' id='labCredito'></h4>
		<h4 id='labSubTotal'>SUB-TOTAL $ 0.00</h4>
		<h3 id='labTotal'>TOTAL $ 0.00</h3>
	</div>
</div>

<button type="button" style='width:380px'  onclick='abreVentana()' id='btnLiquidar' class="btn btn-large btn-success">Liquidar</button>
<script>
function abreVentana(){
	if(seleccion.length>0){

	$("#ventanaLiquidar").dialog("open"); 
	$( "#ventanaLiquidar" ).dialog({
  		height:500,
  		width:900,
	});

	$("#ventanaLiquidar").dialog('option', 'position', 'center');
	//cambiaImporteTotal();
	
}else{
	swal({   title: "Opss..",  text: 'Debe seleccionar algún item!',html: true,  type: "error"},function(){$(".btn").button("reset")});

}
$("#btnLiquidar").button("reset");
}
function mostrarItems()
{
	var sal="<small><table class='table table-condensed'>";
	sal+="<tbody>";
	sal+="<tr>";
			sal+="<th>Detalle</th>";
			sal+="<th>Interés</th>";
			sal+="<th>Importe</th>";
			sal+="<th></th>";
	sal+="</tr>";
	console.log('agregando itemns');
	for(var i=0;i<seleccion.length;i++){
		sal+="<tr>";
			sal+="<td>";
			if(seleccion[i].tipo=="paraCobrar")
				sal+=seleccion[i].entidad+'|'+seleccion[i].propiedad+'|'+seleccion[i].detalle+'|';
			else sal+=seleccion[i].detalle;
			sal+="</td>";
			sal+="<td><input type='text' class='span1' onchange='cambiaInteresSeleccion("+i+")' id='interesFacturar_"+i+"' value='";
			sal+=seleccion[i].interes.toFixed(2);
			sal+="'></input></td>";
			var cadComp="<td><input type='text' class='span1' onchange='cambiaImporteSeleccion("+i+")' id='itemFacturar_"+i+"' value='"+seleccion[i].saldo.toFixed(2)+"' </input></td>";
			var cadPara="<td>"+seleccion[i].saldo.toFixed(2)+"</td>";
			if(seleccion[i].tipo=="comp")sal+=cadComp;else sal+=cadPara;
			sal+="<td style='width:15px'><img title='Quitar Item' onclick='quitarItemSeleccion("+seleccion[i].id+", \""+seleccion[i].tipo+"\" )' style='cursor:pointer' src='images/iconos/glyphicons/glyphicons_199_ban.png'/></td>";
		sal+="</tr>";
	}
	sal+="</tbody>";
	sal+="</table></small>";
	$('#itemsParaLiquidar').html(sal);
}
function quitarItemSeleccion(id,tipo)
{
	quitar(id,tipo);
	mostrarInfo();
}
function cambiaInteresSeleccion(i)
{
	seleccion[i].interes=$('#interesFacturar_'+i).val()*1;
	mostrarInfo();
}
function cambiaImporteSeleccion(i)
{
	var valor=$('#itemFacturar_'+i).val()*1;
	if(valor> seleccion[i].saldo) 
		swal({   title: "Opss..",  text:  'El valor no puede ser mayor al saldo('+seleccion[i].saldo.toFixed(2)+')!',  html: true,  type: "error"});
		
	else seleccion[i].saldo=valor;
	mostrarInfo();
}
</script>