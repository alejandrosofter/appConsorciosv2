<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEdificio')); ?>:</b>
	<?php echo CHtml::encode($data->idEdificio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoGasto')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoGasto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idComprobante')); ?>:</b>
	<?php echo CHtml::encode($data->idComprobante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idGastoLigado')); ?>:</b>
	<?php echo CHtml::encode($data->idGastoLigado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('esFondoReserva')); ?>:</b>
	<?php echo CHtml::encode($data->esFondoReserva); ?>
	<br />


</div>