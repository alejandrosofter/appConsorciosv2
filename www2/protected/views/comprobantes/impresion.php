<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<script src="js/printThis/printThis.js"></script>
<?php $tama=Settings::model()->getValorSistema('SIZE_COMPROBANTES_FUENTE');?>
<style>
table{
	font-size: <?=$tama?>px;
	font-family: "arial";
	border-collapse: collapse;
	 border-style: solid;
	 border: 1px solid black;
}
</style>
</head>
<body>
<?php if($conImpresion){?>
<button style='width:100%' onclick='imprimirPapel()'><big>Imprimir</big></button> <br>
<?php }?>
<?=$texto;?>

<div style="position:absolute; top:700px"><?=Settings::model()->getValorSistema('IMPRESION_DUPLICADO')=="1"?$texto:""?></div>
<script>

function imprimirPapel(debugFalg)
{
    $(".impresionPapel").printThis({
      debug: debugFalg,             
      importCSS: true,           
      printContainer: true,      
      //loadCSS: "css/impresionComprobante.css",             
      removeInline: false        
  });
}
</script>
</body>
</html>