<div style="margin: 50px">
<h1 style="color:green">Se ha completado la operación!</h1>
<i>Gracias por confiar en nuestro servicio</i><br>
<?php 
$arr=explode('.', $model->nombreArchivo);
if($arr[1]=="pdf") echo '<embed src= "images/avisoPagos/'.$model->nombreArchivo.'" width= "800" height= "575">
'; else echo "<img style='width:100%' src='images/avisoPagos/".$model->nombreArchivo."'>";
?>
</div>