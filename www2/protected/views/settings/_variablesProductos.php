<h3>Variables de Productos</h3>
<h3>IMPRESIONES</h3>
	<div class="row">
		<b><?php echo 'Cantidad de etiquetas por FILA (impresiones)' ?></b>
		<?php echo CHtml::textField('ETIQUETAS_CANTIDAD_POR_FILA',Settings::model()->getValorSistema('ETIQUETAS_CANTIDAD_POR_FILA'),array('class'=>'span1','maxlength'=>64)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>Cantidad de etiquetas por fila.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Cantidad de caracteres en nombre (impresiones)' ?></b>
		<?php echo CHtml::textField('ETIQUETAS_CANTIDAD_CARACTERES_NOM',Settings::model()->getValorSistema('ETIQUETAS_CANTIDAD_CARACTERES_NOM'),array('class'=>'span1','maxlength'=>64)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>Cantidad de caracteres por fila.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Cantidad de caracteres en nombre FRONTAL (impresiones)' ?></b>
		<?php echo CHtml::textField('ETIQUETAS_CANTIDAD_FRONTAL_CARACTERES_NOM',Settings::model()->getValorSistema('ETIQUETAS_CANTIDAD_FRONTAL_CARACTERES_NOM'),array('class'=>'span1','maxlength'=>64)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>Cantidad de caracteres por fila.</span>
		
	</div>