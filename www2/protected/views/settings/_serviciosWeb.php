<div class="">
        <p><?php echo 'Frase Servicios' ?>
        <?php echo CHtml::textField('WEB_FRASESERVICIOS',Settings::model()->getValorSistema('WEB_FRASESERVICIOS'),array('class'=>'span5','size'=>50)); ?>
        
        </p>
</div>
<div class="">
		<p><?php echo 'Cuerpo Servicios' ?>
		<?php $this->widget(
    'bootstrap.widgets.TbCKEditor',
    array(
        'name' => 'WEB_CUERPOSERVICIOS',
        'value'=>Settings::model()->getValorSistema('WEB_CUERPOSERVICIOS'),
        'attribute'=>'texto','htmlOptions'=>array('style'=>'width:100%')
    )
); ?>
		
		</p>
</div>