<h4><b>TAREAS</b> <small>Grales</small></h4>
<a style="float:right"  onclick="agregarTarea()" id="addButton" href="#nuevaTarea" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> <b>NUEVA </b>Tarea</a>
<?=$this->renderPartial("/tareas/buscador");?> 
<div style="padding:10px" id="printable">
  <div id="tareas"> <i>No hay resultados...</i></div>
</div>

<a style="float:right"  onclick="imprimir()" id="printBtn"  class="btn btn-warning"><i class="icon-print icon-white"></i> </a>

<script>
  buscar()
function resetCarga()
  {
    $("#detalleTarea").val("");
  }
	function quitarTarea(id)
  {
		$.blockUI({ message: '<h5> QUITANDO TAREA...</h5>' });
    $.get("index.php?r=tareas/quitar",{id:id},function(res){
			$.unblockUI();
      buscar()
    });
  }
function nuevaTarea()
  {
    $.get("index.php?r=tareas/nueva",{detalle:$("#detalleTarea").val(),idEdificio:$("#nuevatarea_edificio").val()},function(res){
      
      resetCarga();
      buscar();
       $.fancybox.close();
    });
  }
  function imprimir()
  {
    $("#printable").printThis({
     // debug: debugFalg,             
      importCSS: true,       
      header: "<h1>LISTADO DE TAREAS "+$('#nuevatarea_edificio option:selected').text()+"</h1>",
      footer: "",
      printContainer: false,      
      pageTitle: "",             
      removeInline: false        
  });
    setTimeout(
  function() 
  {
   $(".btn").button('reset');
    console.log("RESET?")
  }, 1000);
    	
  }
  function agregarTarea()
  {
    $.fancybox.open([
    {
        href : '#nuevaTarea',
    maxWidth	: 500,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
      'beforeClose': function() { console.log("carro?");$(".btn").button("reset") },
    
    },   
], {
    padding : 0   
});
  }
function mostrarTabla(items)
  {
    var res="<table class='table table-condensed'><tr><th>Fecha</th><th>Detalle</th><th>ESTADO</th><th style='width:120px'></th></tr>";
    for(var i=0;i<items.length;i++){
      var item=items[i];
      var claseFila=item.estado=="PENDIENTE"?"error":"success";
      res+="<tr class='"+claseFila+"'><td>"+item.fecha+"</td><td>"+item.detalleTarea+"</td><td>"+item.estado+"</td><td><button title='Cambiar Estado' class='btn btn-success btn-mini' onclick='cambiarEstado("+item.id+",\""+item.estado+"\")' ><i class='icon-adjust icon-white'></i></button> <button title='Quitar' class='btn btn-danger btn-mini' onclick='quitarTarea("+item.id+")' ><i class='icon-remove icon-white'></i></button></td></tr>";
    }
    res+="</table>";
    $("#tareas").html(res)
  }
function buscar(muestraMensaje)
  {
    if(muestraMensaje)$.blockUI({ message: '<h5> Buscando Tareas <b>'+$("#estado").val()+'</b></h5>' });
		
    $.getJSON("index.php?r=tareas/buscar",{idEdificio:$("#idEdificio").val(),estado:$("#estado").val()},function(res){
      $.unblockUI();
      mostrarTabla(res);
			$(".btn").button('reset')
    });
  }
  function cambiarEstado(id,estado)
  {
    $.getJSON("index.php?r=tareas/cambiaEstado",{id:id,estado:estado},function(res){
       buscar(true);
			
    });
  }
</script>
<div style="display:none;padding:15px" id="nuevaTarea">
  <h2><b>NUEVA</b> Tarea</h2>
   <?php 
$data = Edificios::model()->findAll();
$list = CHtml::listData($data,  'id', 'nombreEdificio');
echo CHtml::dropDownList('nuevatarea_edificio', "",  $list, array("onchange"=>"","style"=>"width:120px"));
?> 
  <textarea placeholder="Detalle de la Tarea" id="detalleTarea" cols="5" style="width:100%;height:80px"></textarea>
  <button id="btnAceptar" onclick="nuevaTarea()" class="btn btn-primary" style="width:100%"><b>ACEPTAR</b> </button>
</div>