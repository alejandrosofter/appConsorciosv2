<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('solicitante')); ?>:</b>
	<?php echo CHtml::encode($data->solicitante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefonos')); ?>:</b>
	<?php echo CHtml::encode($data->telefonos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tipoConsulta')); ?>:</b>
	<?php echo CHtml::encode($data->tipoConsulta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importeDesde')); ?>:</b>
	<?php echo CHtml::encode($data->importeDesde); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importeHasta')); ?>:</b>
	<?php echo CHtml::encode($data->importeHasta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoPropiedad')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoPropiedad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idUbicacion')); ?>:</b>
	<?php echo CHtml::encode($data->idUbicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidadHabitaciones')); ?>:</b>
	<?php echo CHtml::encode($data->cantidadHabitaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidadBanos')); ?>:</b>
	<?php echo CHtml::encode($data->cantidadBanos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tienePatio')); ?>:</b>
	<?php echo CHtml::encode($data->tienePatio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tieneQuincho')); ?>:</b>
	<?php echo CHtml::encode($data->tieneQuincho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publicaWeb')); ?>:</b>
	<?php echo CHtml::encode($data->publicaWeb); ?>
	<br />

	*/ ?>

</div>