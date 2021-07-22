<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEntidad')); ?>:</b>
	<?php echo CHtml::encode($data->idEntidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importe')); ?>:</b>
	<?php echo CHtml::encode($data->importe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle')); ?>:</b>
	<?php echo CHtml::encode($data->detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nroComprobante')); ?>:</b>
	<?php echo CHtml::encode($data->nroComprobante); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoComprobante')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoComprobante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interesDescuento')); ?>:</b>
	<?php echo CHtml::encode($data->interesDescuento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTalonario')); ?>:</b>
	<?php echo CHtml::encode($data->idTalonario); ?>
	<br />

	*/ ?>

</div>