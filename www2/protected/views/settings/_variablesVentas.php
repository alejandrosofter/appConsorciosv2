<h4>Variables de Ventas</h4>
<h3>Presupuestos</h3>
<div class="row">
		<b><?php echo 'Condiciones/Anexos(Default)' ?></b>
		
               <?php echo CHtml::textArea('PRESUPUESTOS_ANEXOS',Settings::model()->getValorSistema('PRESUPUESTOS_ANEXOS'),array('class'=>'span6','rows'=>3)); 
		
		?>
		<span class='help-block'><b>NOTA: </b> Seleccion por default cuando se crea un presupuesto </span>
		
	</div>
<div class="row">
		<b><?php echo 'Formas de Pago(Default)' ?></b>
		
               <?php echo CHtml::textArea('PRESUPUESTOS_FORMASPAGO',Settings::model()->getValorSistema('PRESUPUESTOS_FORMASPAGO'),array('class'=>'span6','rows'=>3)); 
		
		?>
		<span class='help-block'><b>NOTA: </b> Seleccion por default cuando se crea un presupuesto </span>
		
	</div>
<h3>Impresiones</h3>
<div class="row">
		<b><?php echo 'Imprime Factura Rapida (default)' ?></b>
		
                <?php echo  CHtml::dropDownList('IMPRIME_FACTURA_RAPIDA_DEF',Settings::model()->getValorSistema('IMPRIME_FACTURA_RAPIDA_DEF'),FacturasEntrantes::model()->getEstadosAlertas());?>
		
		<span class='help-block'><b>NOTA: </b> Seleccion por default para la impresion </span>
		
	</div>
<div class="row">
		<b><?php echo 'Cantidad Copias (factura Completa)' ?></b>
		<?php echo CHtml::textField('IMPREISON_FACTURA_CANTIDAD_COMPLETAFAC',Settings::model()->getValorSistema('IMPREISON_FACTURA_CANTIDAD_COMPLETAFAC'),array('class'=>'span1','maxlength'=>64)); 
		
		?>
		<span class='help-block'><b>NOTA: </b> Cantidad de copias que imprime al generar una factura completa </span>
		
	</div>
<div class="row">
		<b><?php echo 'Cantidad Copias recibo (factura rapida)' ?></b>
		<?php echo CHtml::textField('IMPREISON_RECIBO_CANTIDAD_RAPIDAFAC',Settings::model()->getValorSistema('IMPREISON_RECIBO_CANTIDAD_RAPIDAFAC'),array('class'=>'span1','maxlength'=>64)); 
		
		?>
		<span class='help-block'><b>NOTA: </b> Cantidad de copias que imprime al generar una factura rapida </span>
		
	</div>

<h3>General</h3>
		<div class="row">
		<b><?php echo 'ID condicion CONTADO' ?></b>
		<?php echo CHtml::textField('ID_CONTADO',Settings::model()->getValorSistema('ID_CONTADO'),array('class'=>'span2','maxlength'=>64)); 
		echo CHtml::link(' Ir a la condicion',
                    Yii::app()->createUrl("condicionesVenta/update",array("id"=>Settings::model()->getValorSistema('ID_CONTADO'))));
		?>
		<span class='help-block'><b>NOTA: </b>Busque en <?php echo CHtml::link(' condiones de venta',
                    Yii::app()->createUrl("condicionesVenta/index")); ?> el ID de la condicion CONTADO.</span>
		
	</div>
		<div class="row">
		<b><?php echo 'ID del cliente CONSUMIDOR FINAL' ?></b>
		<?php echo CHtml::textField('IDCLIENTE_CONSUMIDORFINAL',Settings::model()->getValorSistema('IDCLIENTE_CONSUMIDORFINAL'),array('class'=>'span2','maxlength'=>64)); 
		echo CHtml::link(' Ir al Cliente',
                    Yii::app()->createUrl("clientes/update",array("id"=>Settings::model()->getValorSistema('IDCLIENTE_CONSUMIDORFINAL'))));
		?>
		
		<span class='help-block'><b>NOTA: </b>Busque el ID en <?php echo CHtml::link(' clientes',
                    Yii::app()->createUrl("clientes/index")); ?>.</span>
		
	</div>
	<div class="row">
		<b><?php echo 'Alertas Asignacion de Precios' ?></b>
		<?php echo  CHtml::dropDownList('VENTAS_ALERTAS_PRECIOS',Settings::model()->getValorSistema('VENTAS_ALERTAS_PRECIOS'),FacturasEntrantes::model()->getEstadosAlertas());?>
		

		
		<span class='help-block'><b>NOTA: </b>Desactiva o Activa las alertas para la asignacion de precios .</span>
		
	</div>
<h3>Precios</h3>
	<div class="row">
		<b><?php echo '% de Venta en Asignación de Precio de productos' ?></b>
		<?php echo CHtml::textField('PORCENTAJE_VENTA_PRODUCTO',Settings::model()->getValorSistema('PORCENTAJE_VENTA_PRODUCTO'),array('class'=>'span2','maxlength'=>64)); ?>
		<span class='help-block'><b>NOTA: </b>Longitud maxima para la Impresion de la orden.</span>
		
	</div>
<h3>Facturacion Electronica</h3>
	<div class="row">
		<b><?php echo 'Estado' ?></b>
		<?php echo  CHtml::dropDownList('FE_ACTIVA',Settings::model()->getValorSistema('FE_ACTIVA'),FacturasEntrantes::model()->getEstadosAlertas());?>
		<span class='help-block'><b>NOTA: </b>Activacion de la facturacion electronica.</span>
		
	</div>
