<h3>Datos de la Empresa</h3>
<div style="margin:15px">
	<div class="">
		<b><?php echo 'Host' ?></b>
		<?php echo CHtml::textField('EMAIL_HOST',Settings::model()->getValorSistema('EMAIL_HOST'),array('class'=>'span3','size'=>50)); ?>
	</div>
	<div class="">
		<b><?php echo 'Port' ?></b>
		<?php echo CHtml::textField('EMAIL_PORT',Settings::model()->getValorSistema('EMAIL_PORT'),array('class'=>'span1','size'=>50)); ?>
	</div>
	<div class="">
		<b><?php echo 'Secure' ?></b>
		<?php echo CHtml::textField('EMAIL_SECURE',Settings::model()->getValorSistema('EMAIL_SECURE'),array('class'=>'span1','size'=>50)); ?>
	</div>
	<div class="">
		<b><?php echo 'Usuario' ?></b>
		<?php echo CHtml::textField('EMAIL_USUARIO',Settings::model()->getValorSistema('EMAIL_USUARIO'),array('class'=>'span3','size'=>50)); ?>
	</div>
	<div class="">
		<b><?php echo 'Clave' ?></b>
		<?php echo CHtml::textField('EMAIL_CLAVE',Settings::model()->getValorSistema('EMAIL_CLAVE'),array('class'=>'span2','size'=>50)); ?>
	</div>
	<a onclick="testMail()" id="btnTest" class="btn btn-success"><b>TEST</b> MAIL</a>

</div>
<script>
function testMail()
	{
		$.getJSON("index.php?r=mail/test",function(res){
			$("#btnTest").button('reset');
			console.log(res)
		})
	}
</script>