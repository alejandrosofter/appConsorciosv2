<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombrePropiedad')); ?>:</b>
	<?php echo CHtml::encode($data->nombrePropiedad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoPropiedad')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoPropiedad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEdificio')); ?>:</b>
	<?php echo CHtml::encode($data->idEdificio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPropiedadPadre')); ?>:</b>
	<?php echo CHtml::encode($data->idPropiedadPadre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />


</div>