<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idDominio')); ?>:</b>
	<?php echo CHtml::encode($data->idDominio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEntidadLocador')); ?>:</b>
	<?php echo CHtml::encode($data->idEntidadLocador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEntidadLocatario')); ?>:</b>
	<?php echo CHtml::encode($data->idEntidadLocatario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->fechaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaVencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fechaVencimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPlantilla')); ?>:</b>
	<?php echo CHtml::encode($data->idPlantilla); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaRecesion')); ?>:</b>
	<?php echo CHtml::encode($data->fechaRecesion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('depositoGarantia')); ?>:</b>
	<?php echo CHtml::encode($data->depositoGarantia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comisionAdministracion')); ?>:</b>
	<?php echo CHtml::encode($data->comisionAdministracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('punitoriosDia')); ?>:</b>
	<?php echo CHtml::encode($data->punitoriosDia); ?>
	<br />

	*/ ?>

</div>