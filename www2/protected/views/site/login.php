<style>
.invalido {
	font-size: 13px;
	color: #fc1717;
}
</style>
<form action="index.php?r=site/login" method="POST" id="login-form">
		
			<fieldset>

				<p>
					<label for="login-username">nombre de usuario</label>
					<input type="text" name='username' id="login-username" class="round full-width-input" autofocus />
				</p>

				<p>
					<label for="login-password">clave</label>
					<input type="password" name='password' id="login-password" class="round full-width-input" />
				</p>
				<div class='invalido'><?=$invalido?'Datos para el ingreso incorrectos!':'';?></div>
				<a onclick="document.getElementById('login-form').submit()" class="button round blue image-right ic-right-arrow">INGRESAR</a>
				<a style='float:right' href='index.php' class="button round green image-left ic-left-arrow">volver</a>

			</fieldset>
			<br><div style='float:right'><small ><small><i>Recomendaciones para el sistema</i></small></small> <a target='_blank' href='http://www.mozilla.org/'> <img src='images/firefox.jpg'/> </a> <a target='_blank' href='http://www.google.com/chrome?hl=es'><img src='images/chrome.jpg'/></a></div>
			<br/><br/><div class="information-box round">En caso de no tener acceso por favor, enviar un mail a <a href="mailto:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>"><?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?></a></div>

		</form>
		<script>
		$('#login-password').keypress(function(e) {
    if(e.which == 13) {
        $('#login-form').submit();
    }
});
		</script>