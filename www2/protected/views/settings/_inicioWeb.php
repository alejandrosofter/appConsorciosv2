<div class="">
		<p><?php echo 'Frase de Inicio' ?>
		<?php $this->widget(
    'bootstrap.widgets.TbRedactorJs',
    array(
        'name' => 'WEB_INICIO',
        'value'=>Settings::model()->getValorSistema('WEB_INICIO'),
        'attribute'=>'texto','htmlOptions'=>array('style'=>'width:100%')
    )
); ?>
		
		</p>
</div>
<div class="">
        <p><?php echo 'Cuerpo Inicio' ?>
        <?php $this->widget(
    'bootstrap.widgets.TbCKEditor',
    array(
        'name' => 'WEB_CUERPOINICIO',
        'value'=>Settings::model()->getValorSistema('WEB_CUERPOINICIO'),
        'attribute'=>'texto','htmlOptions'=>array('style'=>'width:100%')
    )
); ?>
        
        </p>
</div>