<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emisor')); ?>:</b>
	<?php echo CHtml::encode($data->emisor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receptor')); ?>:</b>
	<?php echo CHtml::encode($data->receptor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mensaje')); ?>:</b>
	<?php echo $data->mensaje; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />


</div>