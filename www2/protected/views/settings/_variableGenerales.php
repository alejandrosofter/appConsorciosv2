<h3>GENERAL</h3>
<div class="content-form">
	<h3>FORMATO IMPRESIONES</h3>
	<h5>Impresiones</h5>Muestra la suma de las columnas en el resumen de expensas (1 para mostrar)
	<?php echo CHtml::textField('IMPRIME_SUMA_EXPENSAS',Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS'),array('class'=>'span1','maxlength'=>64));?>
	<h4>FORMATO Resumen EXPENSAS</h4>

		<p>
		<?php echo CHtml::textField('FORMATO_EXPENSAS',Settings::model()->getValorSistema('FORMATO_EXPENSAS'),array('class'=>'span1','maxlength'=>64));?>
			<span class='help-block'><b>NOTA: </b>1(es el extendido) 2 (es el resumido).</span>
		<h4>BACKUP A MAIL</h4>

		<p>
		<?php echo CHtml::textField('GENERALES_BACKUPMAIL',Settings::model()->getValorSistema('GENERALES_BACKUPMAIL'),array('class'=>'span1','maxlength'=>64));?>
			<span class='help-block'><b>NOTA: </b>1(es si a la casilla definida en DATOS DE EMAIL) 0 (es no envia).</span>

<h4>Intereses</h4>

		<p><?php echo 'Interes diario' ?>
		<?php echo CHtml::textField('GENERALES_INTERESDIARIO',Settings::model()->getValorSistema('GENERALES_INTERESDIARIO'),array('class'=>'span1','maxlength'=>64));
		
		 ?>
<h4>Coeficiente Propiedades</h4>

		<p><?php echo 'Al 100 por tipo de propiedad' ?>
		<?php echo CHtml::textField('PORCENTAJE_PROPIEDAD_TIPO',Settings::model()->getValorSistema('PORCENTAJE_PROPIEDAD_TIPO'),array('class'=>'span1','maxlength'=>64));?>
			<span class='help-block'><b>NOTA: </b>Poner en (1) si va a tener los porcentajes de las propiedades al 100% sobre todas las unidades funcionales.</span>
		


<h4>Redondeo</h4>

		<p><?php echo 'Redondeo de Importes' ?>
		<?php echo CHtml::textField('REDONDEO_IMPORTES',Settings::model()->getValorSistema('REDONDEO_IMPORTES'),array('class'=>'span1','maxlength'=>64)); ?>
		 <span class='help-block'><b>NOTA: </b>Por favor ingresar la cantidad de decimales para el redondeo.</span>
		</p>
<h4>Liquidaciones</h4>

		<p><?php echo 'Resta Mes Resumen Expensas' ?>
		<?php echo CHtml::textField('RESTA_MES_EXPENSAS',Settings::model()->getValorSistema('RESTA_MES_EXPENSAS'),array('class'=>'span1','maxlength'=>64));?>
			
		</p>	
		<span class='help-block'><b>NOTA: </b>Indica que si el mes es el numero 8 (AGOSTO), le restara la cantidad de meses ingresada. Ej. si es AGOSTO y se pone como valor 1, quedara en JULIO.</span>
		

<h4>CANTIDAD POR PAGINA</h4>

		<p>
		<?php echo CHtml::textField('FORMATO_CANTPAGINA',Settings::model()->getValorSistema('FORMATO_CANTPAGINA'),array('class'=>'span1','maxlength'=>64));?>
			<span class='help-block'><b>NOTA: </b>En TODAS LAS GRILLAS!.</span>
		
<p><?php echo 'Mensaje MAIL de EXPENSAS' ?>
	<?php
	$this->widget(
    'boostrap.widgets.TbCKEditor',
    array(
        'name' => 'MENSAJE_MAIL_EXPENSAS',
        'id' => 'MENSAJE_MAIL_EXPENSAS',
        'value'=>Settings::model()->getValorSistema('MENSAJE_MAIL_EXPENSAS'),
        'editorOptions' => array(
            // From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
            'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
        )
    )
);
	?>
	 VARIABLES PERMITIDAS: %nombreEmpresa, %direccion,%telefono,%emailAdmin,%horarios,%lugarPago
		</p>
<p><?php echo 'Imprime Duplicado en Comprobantes?' ?>
		<?php echo CHtml::textField('IMPRESION_DUPLICADO',Settings::model()->getValorSistema('IMPRESION_DUPLICADO'),array('class'=>'span1','maxlength'=>64));
		
		 ?>
		 1 en caso verdadero 0 para falso.
		</p>
<p><?php echo 'Tamaño FUENTE expensas' ?>
		<?php echo CHtml::textField('SIZE_EXPENSAS_FUENTE',Settings::model()->getValorSistema('SIZE_EXPENSAS_FUENTE'),array('class'=>'span1','maxlength'=>64));
		
		 ?>
		</p>
		<p><?php echo 'Tamaño FUENTE comprobantes' ?>
		<?php echo CHtml::textField('SIZE_COMPROBANTES_FUENTE',Settings::model()->getValorSistema('SIZE_COMPROBANTES_FUENTE'),array('class'=>'span1','maxlength'=>64));
		
		 ?>
		</p>
	<h3>GENERALES</h3>

		<p><?php echo 'Cantidad dias DESDE VENCIMIENTOS' ?>
		<?php echo CHtml::textField('CANTIAD_DESDE_VENC',Settings::model()->getValorSistema('CANTIAD_DESDE_VENC'),array('class'=>'span1','maxlength'=>64));
		
		 ?>
		</p>
		<p><?php echo 'Cantidad dias HASTA VENCIMIENTOS' ?>
		<?php echo CHtml::textField('CANTIAD_HASTA_VENC',Settings::model()->getValorSistema('CANTIAD_HASTA_VENC'),array('class'=>'span1','maxlength'=>64));
		
		 ?>
		</p>

</div>