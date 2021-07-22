<h3>VARIABLES DE USUARIO</h3>
<h4>IMPRESORAS</h4>
<i>En caso de no haber impresoras dejar en vacio (de esta manera el sistema preguntara que impresora usar).</i>
<div class="row">
		<b><?php echo 'Tiket Fiscal' ?></b>
		<?php echo CHtml::textField('IMPRESORA_TICKET_FISCAL_USUARIO',Settings::model()->getValorSistema('IMPRESORA_TICKET_FISCAL_USUARIO',null,null,Yii::app()->user->id),array('class'=>'span6','maxlength'=>300));
		
		 ?>
                <?php echo  CHtml::dropDownList('HOJA_TICKET_FISCAL_USUARIO',Settings::model()->getValorSistema('HOJA_TICKET_FISCAL_USUARIO',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoHojas());?>
		
		
		<span class='help-block'><b>NOTA: </b>COLOCAR EL NOMBRE DEL LA IMPRESORA y LUEGO EL PUERTO. EJ: EPSON TM-U220AF -COM1 .</span>
		
	</div>
<div class="row">
<div class="row">
		<b><?php echo 'Impresora Ticket' ?></b>
		<?php echo CHtml::textField('IMPRESORA_TICKET_USUARIO',Settings::model()->getValorSistema('IMPRESORA_TICKET_USUARIO',null,null,Yii::app()->user->id),array('class'=>'span6','maxlength'=>300));
		
		 ?>
                <?php echo  CHtml::dropDownList('HOJA_TICKET_USUARIO',Settings::model()->getValorSistema('HOJA_TICKET_USUARIO',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoHojas());?>
		
		
		<span class='help-block'><b>NOTA: </b>Nombre de la Impresora para hacer Tickets .</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresora Principal' ?></b>
		<?php echo CHtml::textField('IMPRESORA_PRINCIPAL_USUARIO',Settings::model()->getValorSistema('IMPRESORA_PRINCIPAL_USUARIO',null,null,Yii::app()->user->id),array('class'=>'span6','maxlength'=>300));
		
		 ?>
		<?php echo  CHtml::dropDownList('HOJA_PRINCIPAL_USUARIO',Settings::model()->getValorSistema('HOJA_PRINCIPAL_USUARIO',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoHojas());?>
		<span class='help-block'><b>NOTA: </b>Nombre de la Impresora Principal (para imprimir presupuestos, hojas en A4 comunmente) .</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresora Secundaria' ?></b>
		<?php echo CHtml::textField('IMPRESORA_SECUNDARIA_USUARIO',Settings::model()->getValorSistema('IMPRESORA_SECUNDARIA_USUARIO',null,null,Yii::app()->user->id),array('class'=>'span6','maxlength'=>300));
		
		 ?>
		<?php echo  CHtml::dropDownList('HOJA_SECUNDARIA_USUARIO',Settings::model()->getValorSistema('HOJA_SECUNDARIA_USUARIO',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoHojas());?>
		
		<span class='help-block'><b>NOTA: </b>Nombre de la Impresora Secundaria (para imprimir presupuestos, hojas en A4 comunmente) .</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresora de Etiquetas' ?></b>
		<?php echo CHtml::textField('IMPRESORA_ETIQUETAS_USUARIO',Settings::model()->getValorSistema('IMPRESORA_ETIQUETAS_USUARIO',null,null,Yii::app()->user->id),array('class'=>'span5','maxlength'=>300));
		
		 ?>
		<?php echo  CHtml::dropDownList('HOJA_ETIQUETAS_USUARIO',Settings::model()->getValorSistema('HOJA_ETIQUETAS_USUARIO',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoHojas());?>
		
		<span class='help-block'><b>NOTA: </b>Nombre de la Impresora para hacer etiquetas (para imprimir codigos de Barra) .</span>
		
	</div>
<div class="row">
		<b><?php echo 'Hoja Personalizado 1' ?></b>
		<?php echo CHtml::textField('HOJA_PERSONALIZADO1x',Settings::model()->getValorSistema('HOJA_PERSONALIZADO1x',null,null,Yii::app()->user->id),array('class'=>'span1','maxlength'=>300));
		
		 ?>
                 x 
                <?php echo CHtml::textField('HOJA_PERSONALIZADO1y',Settings::model()->getValorSistema('HOJA_PERSONALIZADO1y',null,null,Yii::app()->user->id),array('class'=>'span1','maxlength'=>300));
		
		 ?>
		
		<span class='help-block'><b>NOTA: </b>Hoja personalizada.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Hoja Personalizado 2' ?></b>
		<?php echo CHtml::textField('HOJA_PERSONALIZADO2x',Settings::model()->getValorSistema('HOJA_PERSONALIZADO2x',null,null,Yii::app()->user->id),array('class'=>'span1','maxlength'=>300));
		
		 ?>
                 x 
                <?php echo CHtml::textField('HOJA_PERSONALIZADO2y',Settings::model()->getValorSistema('HOJA_PERSONALIZADO2y',null,null,Yii::app()->user->id),array('class'=>'span1','maxlength'=>300));
		
		 ?>
		
		<span class='help-block'><b>NOTA: </b>Hoja personalizada 3.</span>
		
	</div>
<h4>ASIGNACION DE IMPRESORAS</h4>
<div class="row">
		<b><?php echo 'Impresion de Ordenes de Trabajo' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_ORDENES_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_ORDENES_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Notas de Credito' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_NOTACREDITO_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_NOTACREDITO_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Facturas A' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_FACTURAS_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_FACTURAS_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Facturas B' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_FACTURAS_IMPRESORA_B',Settings::model()->getValorSistema('IMPRESION_FACTURAS_IMPRESORA_B',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Facturas X' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_FACTURAS_IMPRESORAX',Settings::model()->getValorSistema('IMPRESION_FACTURAS_IMPRESORAX',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Ordenes de Pago' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_ORDENPAGO_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_ORDENPAGO_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Ordenes de Cobro' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_ORDENCOBRO_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_ORDENCOBRO_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>

<div class="row">
		<b><?php echo 'Impresion de Recibo' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_RECIBO_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_RECIBO_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Presupuestos' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_PRESUPUESTOS_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_PRESUPUESTOS_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Codigo de Barras' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_CODBARRAS_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_CODBARRAS_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Tareas' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_TAREAS_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_TAREAS_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>
<div class="row">
		<b><?php echo 'Impresion de Informes' ?></b>
		<?php echo  CHtml::dropDownList('IMPRESION_INFORMES_IMPRESORA',Settings::model()->getValorSistema('IMPRESION_INFORMES_IMPRESORA',null,null,Yii::app()->user->id),FacturasEntrantes::model()->getTipoImpresiones());?>
		
		
		<span class='help-block'><b>NOTA: </b>Automaticamente la impresora usa esta impresora al imprimir.</span>
		
	</div>