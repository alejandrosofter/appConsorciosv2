<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPropiedad')); ?>:</b>
	<?php echo CHtml::encode($data->idPropiedad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEntidad')); ?>:</b>
	<?php echo CHtml::encode($data->idEntidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoEntidadPropiedad')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoEntidadPropiedad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paga')); ?>:</b>
	<?php echo CHtml::encode($data->paga); ?>
	<br />


</div>