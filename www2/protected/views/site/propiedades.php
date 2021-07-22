<div class="inner-page-bg bg2">
				<div class="inner-content">
					<h2 class="colored-bg">Propiedades</h2>
				</div>
			</div>
<?php 
if(count($model)==0)echo'<small><strong>No se encontraron resultados</strong>, por favor revise los filtros y vuelva a intentarlo.</small>';
foreach($model as $propiedad): ?>
        <?$this->renderPartial('_disponible',array('data'=>$propiedad));?>
  
<?php endforeach; ?>

<?$this->renderPartial('_paginador',array('total'=>false,'curr'=>1,'porPag'=>5,'align'=>'right','cantResultados'=>count($model)));?>