<div style="float:right">
  		<a  onclick='imprimirAnual()' style='' class="btn btn-primary" href="#"><i class="icon-print icon-white"></i> <b>IMPRIMIR</b> Planilla</a>
<a class="imprime btn btn-warning" data-fancybox-type="iframe" title="" data-toggle="tooltip" href="index.php?r=paraCobrar/mailsMorosos&idEdificio=<?=$_GET['idEdificio']?>&ano=<?=$_GET['ano']?>" data-original-title="Envia Mail"><i class="icon-envelope icon-white"></i> <b>NOTIFICAR</b> Deuda</a>
</div>
<div id="imprimeAnual" >

<h2><?=$params['rz']?> <small><?=$params['ano']?> <?=$params['edificio']?></small></h2>
  
  <small>
    
<table class="table table-condensed">
				<thead><tr><th>PROPIEDAD</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>TOTAL</th></tr></thead>
				<tbody>
				<?php $ARR_SUM=[];
				foreach($anual as $prop){
	
					$SUM_DEUDA=0;
					?>
	  <tr>
			<th><small><a class="imprime " data-fancybox-type="iframe" title="CTA CTE PROP: <?=isset($prop->inquilino)?$prop->inquilino->razonSocial:"-";?>" data-toggle="tooltip" href="index.php?r=paraCobrar/ctaCte&id=<?=$prop->id?>&ano=<?=$_GET['ano']?>" data-original-title="CTA CTE ">
 <?=$prop->nombrePropiedad?></a></small></th>
					<?php for($i=1;$i<=12;$i++){
						 $imp=$prop->getDeudaMes($_GET['ano'],$i,true);
// 					$auxDEUDA=isset($deuda['balance'])?$deuda['balance']:0;
					$SUM_DEUDA+=$imp;
						$inxArr=$i-1;
						if(!isset($ARR_SUM[$inxArr]))$ARR_SUM[]=0;
						$ARR_SUM[$inxArr]+=$imp;
			?>
			<td><small><?=number_format($imp)?></small></td>
			<?php }?>
			<td><?=number_format($SUM_DEUDA)?></td>
		</tr>
	  <?php }?>
					<tr> <th><small>TOTAL</small></th>
					<?php $TOTAL=0; foreach($ARR_SUM as $suma){?>
					<?php $TOTAL+=$suma; ?>
					<td><?=number_format($suma)?></td>
						<?php }?>
				  <td><?=number_format($TOTAL)?></td>
				  </tr>
				</tbody>
				
			</table>
    
  </small>
  <i><?=$params['rz']?> <small><?=$params['ano']?> <?=$params['edificio']?></small></i>
  <small><i style="float:right">Tel. <?=$params['telefono']?> Emal: <?=$params['emailAdmin']?></i></small>
	</div>
<br>
<script>
function imprimirAnual()
	{
		$("#imprimeAnual").printThis({
     // debug: debugFalg,  
      header:"<h1></h1>",
      //importCSS: true,           
      printContainer: false,      
      pageTitle: "",             
      removeInline: false        
  });
	}
	function enviarMails()
	{
		
	}
</script>

