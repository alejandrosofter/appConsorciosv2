<div class="row">
	<div class="span7">
		<h3>Pendientes <small>a la fecha</small></h3>
		<?$this->renderPartial('pendientes',array('pendientes'=>$pendientes));?>

		<h3>Ultimos Pagos <small>a la fecha</small></h3>
		<?$this->renderPartial('ultimosPagos',array('ultimos'=>$ultimos));?>
	</div>
	<div class="span3">
		<h3>Liquidaciones <small>de expensas</small></h3>
		<?$this->renderPartial('liquidaciones',array());?>
	</div>
</div>

