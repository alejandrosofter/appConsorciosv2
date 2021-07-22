<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<section id="content">
			<div id="map">
				<p class="container">
					Try to Enable Your JavaScript!
				</p>
			</div>
			<div class="one">
				<div class="one-fourth">
					<p>
						<strong>Nuestras Oficinas</strong>
					</p>
					<p>
						<?=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION')?>
					</p>
					<p>
						<strong>Info de Contacto</strong>
					</p>
					<p style="margin-bottom:0;">
						 T: + <?=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO')?>  E: <a href="mailto:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>"><?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?></a>
					</p>
					<br/>
				</div>
				<div class="inner-content last">
			
						<div class="one-fourth">
							<fieldset>
								<label><strong>Nombre</strong> <span class="required">*</span></label>
								<input type="text" name="name" id="name" value="<?=isset($_POST['name'])?$_POST['name']:''?>" class="text requiredField">
							</fieldset>
							</div>
							<div class="one-fourth">
							<fieldset>
								<label><strong>Email</strong> <span class="required">*</span></label>
								<input type="text" name="email" id="email" value="<?=isset($_POST['email'])?$_POST['email']:''?>" class="text requiredField email">
							</fieldset>
							</div>
							<div class="one-fourth last">
							<fieldset>
								<label><strong>Asunto</strong> <span class="required">*</span></label>
								<input type="text" name="subject" id="subject" value="<?=isset($_POST['subject'])?$_POST['subject']:''?>" class="text requiredField subject">
							</fieldset>
							</div>
							<div class="inner-content last"><br>
							<fieldset>
								<label><strong>Mensaje</strong> <span class="required">*</span></label>
								<textarea name="message" id="message" rows="20" cols="30" class="text requiredField"><?=isset($_POST['message'])?$_POST['message']:''?></textarea>
							</fieldset>
							<fieldset>
								<button class='btn btn-primary' onclick="enviarMail()">Enviar</button>
							</fieldset>
							</div>
			
						<!--END form ID contact_form-->
					</div>
			</div>
			</section>

<script>
function enviarMail()
{
	$.get('index.php?r=site/enviarMail',{nombre:$('#name').val(),email:$('#email').val(),subject:$('#subject').val(),message:$('#message').val()},
	function (data){
		if(data){
			$('#name').val('');
			$('#email').val('');
			$('#subject').val('');
			$('#message').val('');
			alert('Su mensaje ha sido enviado!');

		}else{
			alert('Faltan completar los datos requeridos, por favor completelos y vuelva a intentarlo...');
		}
	});
}
 jQuery.noConflict()(function($){
  $(document).ready(function(){
  var map = $('#map');
		if( map.length ) {
			map.gMap({
				
				address: 'Level 13,  <?=Settings::model()->getValorSistema("DATOS_EMPRESA_DIRECCION")?> <?=Settings::model()->getValorSistema("DATOS_EMPRESA_LOCALIDAD")?>',
				 
				zoom: 18,
				markers: [
					{ 'address' : 'Level 13,  <?=Settings::model()->getValorSistema("DATOS_EMPRESA_DIRECCION")?> <?=Settings::model()->getValorSistema("DATOS_EMPRESA_LOCALIDAD")?>' },
					 
				]
				
			});

		}
	})
});
  </script>