<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idLiquidacion')); ?>:</b>
	<?php echo CHtml::encode($data->idLiquidacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idGasto')); ?>:</b>
	<?php echo CHtml::encode($data->idGasto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importe')); ?>:</b>
	<?php echo CHtml::encode($data->importe); ?>
	<br />


</div>