<div class="">
		<p><?php echo $titulo ?>
		<?php $this->widget(
    'bootstrap.widgets.TbRedactorJs',
    array(
        'name' => $valor,
        'value'=>Settings::model()->getValorSistema($valor),
        'attribute'=>'texto','htmlOptions'=>array('style'=>'width:100%')
    )
); ?>
		<span class='help-block'><b>NOTA: </b><?=$nota?></span>
		
		</p>
</div>