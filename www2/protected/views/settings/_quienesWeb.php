<div class="">
        <p><?php echo 'Frase Quienes Somos' ?>
        <?php echo CHtml::textField('WEB_FRASEQUIENES',Settings::model()->getValorSistema('WEB_FRASEQUIENES'),array('class'=>'span5','size'=>50)); ?>
        
        </p>
</div>
<div class="">
		<p><?php echo 'Cuerpo Quienes Somos?' ?>
		<?php $this->widget(
    'bootstrap.widgets.TbCKEditor',
    array(
        'name' => 'WEB_CUERPOSQUIENES',
        'value'=>Settings::model()->getValorSistema('WEB_CUERPOSQUIENES'),
        'attribute'=>'texto','htmlOptions'=>array('style'=>'width:100%')
    )
); ?>
		
		</p>
</div>