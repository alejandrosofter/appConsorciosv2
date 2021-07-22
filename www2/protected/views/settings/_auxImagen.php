<div>
        <b><?php echo $nombre ?></b>
        <img id='WEB_IMAGEN1' src='images/<?=Settings::model()->getValorSistema($valor)?>'></img>
        <?php echo CHtml::fileField($valor, '', array('id'=>$valor)); ?> 
        <button class="btn btn-danger" onclick='quitarImagen("<?=$valor?>")' type="button">Quitar</button>
        
</div>