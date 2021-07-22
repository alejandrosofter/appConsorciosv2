<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoGasto')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoGasto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPropiedad')); ?>:</b>
	<?php echo CHtml::encode($data->idPropiedad); ?>
	<br />


</div>