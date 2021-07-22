<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idLiquidacion')); ?>:</b>
	<?php echo CHtml::encode($data->idLiquidacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idParaCobrar')); ?>:</b>
	<?php echo CHtml::encode($data->idParaCobrar); ?>
	<br />


</div>