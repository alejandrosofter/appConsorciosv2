<div class="vistaPropiedad one-third">
		<h4><?=$data->nombrePropiedad?></h4>

		
						
<?php 
$tamChico=isset($tamanoChico)?$tamanoChico:40;
$primero=true;
foreach($data->media as $pm){
     		$nombre=Media::model()->generaImagen($pm->media->id,$tamChico);
     		$nombreGrande=Media::model()->generaImagen($pm->media->id,600);
     		$nombreFinal=$primero?$nombreGrande:$nombre;
     		$primero=false;
     		?>
        <a rel="prettyPhoto[gal_<?=$data->id?>]" href="images/propiedades/<?=$nombreGrande?>">
        	<img class="slider_bgr animate-in" src="images/propiedades/<?=$nombreFinal?>"/>
        </a>
       
        <?php }?>
                             		
<?if($data->cantidadBano!=0||$data->cantidadBano!=""){?><img style='padding-right:15px' src='images/bath.jpg' title='Cantidad: <?=$data->cantidadBano?>'/><?}?>
<?if($data->cantidadHabitacion!=0||$data->cantidadHabitacion!=""){?><img style='padding-right:15px' src='images/room.jpg' title='Cantidad: <?=$data->cantidadHabitacion?>'/><?}?>
<?if($data->tienePatio!=0){?><img style='padding-right:15px' src='images/patio.jpg' /><?}?>

<?if($data->importe!=0||$data->importe!=""){?><div class="importeDescripcion">$ <?=$data->importe?></div><?}?>


</div>