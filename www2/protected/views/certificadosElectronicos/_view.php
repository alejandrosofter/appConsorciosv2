<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreCertificado')); ?>:</b>
	<?php echo CHtml::encode($data->nombreCertificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaCreacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechaCreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaExpira')); ?>:</b>
	<?php echo CHtml::encode($data->fechaExpira); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archivoCertificado')); ?>:</b>
	<?php echo CHtml::encode($data->archivoCertificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archivoCsr')); ?>:</b>
	<?php echo CHtml::encode($data->archivoCsr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archivoKey')); ?>:</b>
	<?php echo CHtml::encode($data->archivoKey); ?>
	<br />


</div>