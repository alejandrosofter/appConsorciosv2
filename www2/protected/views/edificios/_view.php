<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreEdificio')); ?>:</b>
	<?php echo CHtml::encode($data->nombreEdificio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domicilio')); ?>:</b>
	<?php echo CHtml::encode($data->domicilio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombrePortero')); ?>:</b>
	<?php echo CHtml::encode($data->nombrePortero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuit')); ?>:</b>
	<?php echo CHtml::encode($data->cuit); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lugarPago')); ?>:</b>
	<?php echo CHtml::encode($data->lugarPago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCondicionIva')); ?>:</b>
	<?php echo CHtml::encode($data->idCondicionIva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proximoRecibo')); ?>:</b>
	<?php echo CHtml::encode($data->proximoRecibo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importeFondoReserva')); ?>:</b>
	<?php echo CHtml::encode($data->importeFondoReserva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('localidad')); ?>:</b>
	<?php echo CHtml::encode($data->localidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provincia')); ?>:</b>
	<?php echo CHtml::encode($data->provincia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cp')); ?>:</b>
	<?php echo CHtml::encode($data->cp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interes')); ?>:</b>
	<?php echo CHtml::encode($data->interes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interesDiaDesde')); ?>:</b>
	<?php echo CHtml::encode($data->interesDiaDesde); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->fechaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTalonario')); ?>:</b>
	<?php echo CHtml::encode($data->idTalonario); ?>
	<br />

	*/ ?>

</div>