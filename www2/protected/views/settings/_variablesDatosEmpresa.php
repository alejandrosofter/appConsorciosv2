<h3>Datos de la Empresa</h3>
<div style="margin:15px">
	<div class="">
		<b><?php echo 'Razón Social de la Empresa' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_RAZONSOCIAL',Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL'),array('class'=>'span5','size'=>50)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>Nombre que se usa para el aspecto financiero e impositivo.</span>
		
	</div>
	<div class="">
		<b><?php echo 'Logo' ?></b>
		<img src='images/<?=Settings::model()->getValorSistema("LOGOEMPRESA")?>'></img>
		<?php echo CHtml::fileField('LOGOEMPRESA', '', array('id'=>'LOGOEMPRESA')); ?> 
		<span class='help-block'><b>NOTA: </b>El archivo debe ser en formato PNG</span>
		
	</div>
<div class="">
		<b><?php echo 'Inicio de Actividad' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_INICIOACTIVIDAD',Settings::model()->getValorSistema('DATOS_EMPRESA_INICIOACTIVIDAD'),array('class'=>'text','maxlength'=>255)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'URL Sistema' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_URL',Settings::model()->getValorSistema('DATOS_EMPRESA_URL'),array('class'=>'text','maxlength'=>255)); 
		
		?>
		<i>Es importante para linkear desde los mails!</i>
		
	</div>

<div class="">
		<b><?php echo 'Ingresos Brutos' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_INGBRUTOS',Settings::model()->getValorSistema('DATOS_EMPRESA_INGBRUTOS'),array('class'=>'text','maxlength'=>255)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'PUNTO VENTA ELECTRONICO' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_PUNTOVENTA',Settings::model()->getValorSistema('DATOS_EMPRESA_PUNTOVENTA'),array('class'=>'span1','maxlength'=>255)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'Nombre de Fantasia de la Empresa ' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_FANTASIA',Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA'),array('class'=>'span5','size'=>50)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>Nombre usado para el informal de las impresiones.</span>
		
	</div>
	<div class="">
		<b><?php echo 'CUIT de la Empresa' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_CUIT',Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT'),array('class'=>'text','maxlength'=>255)); 
		
		?>
		<span class='help-block'><b>NOTA: </b>NO COLOCAR GUIONES ni espacios!.</span>
		
	</div>
<div class="">
		<b><?php echo 'CONDICION IVA' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_CONDICIONIVA',Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA'),array('class'=>'text','maxlength'=>255)); 
		
		?>
		
	</div>
	<div class="">
		<b><?php echo 'Dirección' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_DIRECCION',Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION'),array('class'=>'span5','maxlength'=>255)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'LOCALIDAD' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_LOCALIDAD',Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD'),array('class'=>'text','maxlength'=>255)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'PROVINCIA' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_PROVINCIA',Settings::model()->getValorSistema('DATOS_EMPRESA_PROVINCIA'),array('class'=>'text','maxlength'=>255)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'Teléfonos' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_TELEFONO',Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO'),array('class'=>'span5','maxlength'=>255)); 
		
		?>
	</div>
	<div class="">
		<b><?php echo 'Direción de retiro de Mercaderia/servicios' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_DIRECIONRETIRO',Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECIONRETIRO'),array('class'=>'span5','maxlength'=>255)); 
		
		?>
		
	</div>

	<div class="">
		<b><?php echo 'Horarios de Atención' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_HORARIOS',Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS'),array('class'=>'span5','maxlength'=>255)); 	?>
	</div>
	<div class="">
		<b><?php echo 'Site WEB' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_SITE',Settings::model()->getValorSistema('DATOS_EMPRESA_SITE'),array('class'=>'text','maxlength'=>255)); ?>
	</div>
	<div class="">
		<b><?php echo 'Email Administración' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_EMAILADMIN',Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'),array('class'=>'span4','maxlength'=>255)); ?>
	</div>
<div class="">
		<b><?php echo 'Lugar de Pago' ?></b>
		<?php echo CHtml::textArea('DATOS_EMPRESA_RESENAEMPRESA',Settings::model()->getValorSistema('DATOS_EMPRESA_RESENAEMPRESA'),array('class'=>'text','rows'=>'4','maxlength'=>255));?>
</div>

   </div>