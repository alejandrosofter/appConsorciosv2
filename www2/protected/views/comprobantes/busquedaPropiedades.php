<div style='padding:30px'>
<link rel="stylesheet" href="js/jquery-typeahead-2.3.2/src/jquery.typeahead.css">
<script src="js/jquery-typeahead-2.3.2/src/jquery.typeahead.js"></script>

 <div class="typeahead-container">
        <div class="typeahead-field">
 
            <span class="typeahead-query">
                <input id="buscador" name="hockey_v1[query]" type="search" placeholder="Buscar Propiedad" value='' autocomplete="off">
            </span>
 
        </div>
    </div>

<script>
$.typeahead({
    input: "#buscador",
    minLength: 1,
    order: "asc",
    maxItem:20,
    ttl: 86400000, // 1day
    compression: true,
    backdrop: {
        "opacity": 0.70,
        "filter": "alpha(opacity=70)",
        "background-color": "#fff"
    },
    cache: false,
    display: ["edificio", "propietario","inquilino",'nombrePropiedad'],
   
   template: '<span style=\'color:green\'>{{edificio}} </span> <span style=\'color:blue\'>{{nombrePropiedad}}</span> <span style=\'color:brown\'> {{propietario}} </span> | {{inquilino}} ' 
   ,
    source: {
            url: "index.php?r=propiedades/getPropiedadesBuscador",
     
        
    },
     dropdownFilter: [
        <?php foreach($edificios as $item){
          echo "{
            key: 'edificio',
            value: '".$item->nombreEdificio."',
            display: '<strong>".$item->nombreEdificio."</strong> Edificio'
        },";

        }?>
        {
            value: '*',
            display: 'Todos'
        }
    ],
    callback: {
        onClickAfter: function (node, a, item, event) {
 
            event.preventDefault();

            
            buscarDeuda(item.id,item.idEntidadInquilino);
            $('#buscador').val('');
 
        },
    }
});
idPropiedadSeleccion=0;
function buscarDeuda(id,idEntidadInquilino)
{

    $.getJSON( "index.php?r=paraCobrar/getDeuda&idPropiedad="+id, function( data ) {
      $('#resultadosDeuda').html(data.data);
      idPropiedadSeleccion=id;
      buscarComprobantesImpagos(idEntidadInquilino); // LO PONGO ACA POR QUE EN DATA.DATA ESTA EL SCRIPT
      idEntidad_=idEntidadInquilino;
      $("#idEntidad").val(idEntidadInquilino);
     $("#idEntidad").trigger("chosen:updated");
   

      });
}
var idEntidad_=0;
</script>
<a class="ventana" data-fancybox-type="iframe" id='btnImprime' href=""></a>

<script type="text/javascript">
$(document).ready(function()
{
  $(".ventana").fancybox({
    fitToView : false,
    width   : '80%',
    afterClose : function() {
        location.reload();
        return;
    },
    height    : '100%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'elastic',
    closeEffect : 'elastic'
  });

    
});

</script>
</div>