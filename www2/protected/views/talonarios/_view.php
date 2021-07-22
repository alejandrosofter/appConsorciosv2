<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desde')); ?>:</b>
	<?php echo CHtml::encode($data->desde); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hasta')); ?>:</b>
	<?php echo CHtml::encode($data->hasta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serie')); ?>:</b>
	<?php echo CHtml::encode($data->serie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proximo')); ?>:</b>
	<?php echo CHtml::encode($data->proximo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoTalonario')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoTalonario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('letraTalonario')); ?>:</b>
	<?php echo CHtml::encode($data->letraTalonario); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('esPedeterminado')); ?>:</b>
	<?php echo CHtml::encode($data->esPedeterminado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('esElectronico')); ?>:</b>
	<?php echo CHtml::encode($data->esElectronico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCertificadoElectronico')); ?>:</b>
	<?php echo CHtml::encode($data->idCertificadoElectronico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPlantilla')); ?>:</b>
	<?php echo CHtml::encode($data->idPlantilla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreTalonario')); ?>:</b>
	<?php echo CHtml::encode($data->nombreTalonario); ?>
	<br />

	*/ ?>

</div>