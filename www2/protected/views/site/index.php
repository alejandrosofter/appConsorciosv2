<div class='span12'>
	<div style="float:right;padding:50px">
		<a style="" class="btn btn-large btn-primary" onclick="backupMail()" id="backapear" type="button"><i class="icon-envelope icon-white"></i><b> BACKUP</b> Mail</a>
	</div>

	<h3><img src='images/iconos/glyphicons/glyphicons_049_star.png'/> BIENVENIDO <strong><?=Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL')?>!</strong></h3>

	<div class="span8">
		<?php $this->renderPartial("/tareas/index")?>
	</div>


	
</div>

<script type="text/javascript">
function backupMail()
	{
		$.blockUI({ message: '<h5> Realizando BACKUP y enviando por mail a <b><?=Settings::model()->getValorSistema('EMAIL_USUARIO')?></b>...</h5>' });
		$.getJSON("index.php?r=settings/backupMail",function(res){
			$.unblockUI();
			$("#backapear").button('reset')
		});
	}
function buscarVencimientos()
{
	$.get( "index.php?r=comprobantes/buscaVencimientos",{desde:$('#desde').val(),hasta:$('#hasta').val(),muestraContratos:$( "#muestraContratos" ).attr('checked'),muestraDeudas:$( "#muestraDeudas" ).attr('checked'),muestraComprobantes:$( "#muestraComprobantes" ).attr('checked')}, function( data ) {
	$('#contenedorVencimientos').html("-");
		$('#contenedorVencimientos').html(data);
	});
}
</script>