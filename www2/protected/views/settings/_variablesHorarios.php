<h3>Variables de Horarios</h3>
<div style="margin:15px">
	<div class="">
		<b><?php echo 'Horarios Disponibles' ?></b>
		<?php echo CHtml::textField('DATOS_HORARIOS',Settings::model()->getValorSistema('DATOS_HORARIOS'),array('class'=>'span5','size'=>90)); ?>
		
		<span class='help-block'><b>NOTA: </b>Separar los horarios por ; (punto y coma) y el rango con - (guion) ej. 13:00-15:30;16:00-18:30</span>
		
	</div>
	<div class="">
		<b><?php echo 'Cantidad de Días busca disponibilidad' ?></b>
		<?php echo CHtml::textField('DATOS_HORARIOS_CANTIDAD',Settings::model()->getValorSistema('DATOS_HORARIOS_CANTIDAD'),array('class'=>'span1','size'=>90)); ?>
		
		<span class='help-block'><b>NOTA: </b>Cantidad de días que se busca disponibilidad de horarios ej. si ha seleccionado 20-02-2013 a las 20:30 y no ha encontrado horario el sistema buscara esta cantidad de días adelante.</span>
		
	</div>
	<div class="">
		<b><?php echo 'Cantidad de registros en Proximos' ?></b>
		<?php echo CHtml::textField('CANTIDAD_PROXIMOS_ALERTA',Settings::model()->getValorSistema('CANTIDAD_PROXIMOS_ALERTA'),array('class'=>'span1','size'=>90)); ?>
		
		<span class='help-block'><b>NOTA: </b>Cantidad de registros que mostrara las alertas en el incio del sistema (eventos, comidas, tareas)</span>
		
	</div>

</div>