<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/printThis/printThis.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/sortTable.js', CClientScript::POS_HEAD); ?>

<div id="imprimeCta" >
  <h1><?=$propiedad->edificio->razonSocialConsorcio?> <small>ESTADO DE CUENTA</small></h1>

<div style="float:left"><h4><a title="Click para poner el MAIL para enviar" href="#" onclick="ponerMail('<?=$propiedad->propietario->email?>')">PROPIETARIO:</a> <small><?=isset($propiedad->propietario)?$propiedad->propietario->razonSocial." tel.".$propiedad->propietario->telefono:"-"?></small>   </h4> </div>
<div style="float:right"> <h4><a title="Click para poner el MAIL para enviar" href="#" onclick="ponerMail('<?=$propiedad->inquilino->email?>')">INQUILINO:</a> <small><?=isset($propiedad->inquilino)?$propiedad->inquilino->razonSocial." tel.".$propiedad->inquilino->telefono:"-"?></small></h4></div>


<table id="tablaCtaCte" class="table table-condensed">
				<thead><tr><th style="display:none"></th><th>Liquidacion</th><th>$ Expensas</th><th>$ Pagos</th><th>$ Interes</th><th>$ Saldo</th></tr></thead>
				<tbody>
<?php $sumDebe=0;$sumHaber=0;$sumTotal=0;$sumInteres=0;$i=0; for($i=1;$i<=12;$i++){
          $t=$propiedad->getDeudaMes($_GET['ano'],$i);
	$meses=['ENERO',"FEBRERO",'MARZO','ABRIL',"MAYO",'JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
          ?>
          <?php 
  $colorEstado=$t['estado']=="CANCELADO"?"green":"red";
  $sumDebe+=$t['expensas'];$sumInteres+=$t['interes'];$sumHaber+=$t['pagos'];$sumTotal+=$t['expensas']-$t['pagos']+$t['interes'];$colorSaldo=$sumTotal>0?"red":"black" ?>
<tr><td style="display:none" ><?=$i?></td><td>LIQUIDACION DE EXPENSAS <b><?=$meses[$i-1]?></b><b><small><small><small style='color:<?=$colorEstado?>'> <?=$t['estado']?> </small></small></small></b></td><td><?=number_format($t['expensas'],2)?></td><td><?=number_format($t['pagos'],2)?></td><td><?=number_format($t['interes'],2)?></td><td style="color:<?=$colorSaldo?>"><?=number_format($sumTotal,2)?></td></tr>

<?php }?>
  <tr><th style="display:none" id="colTotales">0</th><th>TOTALES</th><th>$ <?=number_format($sumDebe,2)?></th><th>$ <?=number_format($sumHaber,2)?></th><th>$ <?=number_format($sumInteres,2)?></th><th style="color:<?=$colorSaldo?>">$ <?=number_format($sumTotal,2)?></th></tr>
  </tbody>
  </table>
</div>
<div style="display:none" id="piePag">
  	<a  onclick='imprimirCta()' style='' class="btn btn-primary" href="#"><i class="icon-print icon-white"></i> <b>IMPRIMIR</b> Cta Cte</a>
<div style="float:right">
  <input type="text" class="form" id="email" value="<?=$propiedad->propietario->email;?>" style="width:310px"><br>
  <textarea  rows="3" class="form" id="mensaje" value="" style="width:310px" placeholder="Por favor ingrese en caso de querer enviarle un mensaje..."></textarea><br>
  <button onclick="enviarEmail(<?=$propiedad->id?>)" style="width:310px" class="btn btn-success"> <img title="" style="filter: invert(100%);" src='images/iconos/glyphicons/glyphicons_120_message_full.png'/> ENVIAR <img style='display: none;' id='loader' src='images/loader.gif'/></button>
</div>
</div>
<script>
 //ordenar(0,true)
  setInterval(function(){ $("#piePag").show("slow") }, 1000);
   function ponerMail(email)
  {
    $("#email").val(email)
  }
  function enviarEmail(idPropiedad)
  {
    $("#loader").show();
    $.get("index.php?r=paraCobrar/enviaMail&idPropiedad="+idPropiedad+"&email="+$("#email").val()+"&mensaje="+$("#mensaje").val(),function(res){
       $("#loader").hide();
      alert("EMAIL ENVIADO!")
    });
  }
  function ordenar(columna,reversa)
  {
    if(reversa){
      $("#colTotales").html("0");
    }else{
      $("#colTotales").html("1000");
    }
    var param=reversa?1:0;
     $("#tablaCtaCte").tablesorter();
    var sorting = [[columna,param]];
    $("#tablaCtaCte").trigger("sorton",[sorting]); 
  }
function imprimirCta()
	{
		$("#imprimeCta").printThis({
     // debug: debugFalg,             
      importCSS: true,           
      printContainer: false,      
      pageTitle: "",             
      removeInline: false        
  });
	}
</script>