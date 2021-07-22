<div class="">
<h3>Inquilino</h3>
	<div class="form-inline">
			<img src='images/iconos/glyphicons/inquilino.png'/> 
			<?php echo CHtml::dropDownList('idInquilino',$idInquilino,CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('prompt'=>'seleccione...','style'=>'width:250px','class'=>'chosen')); ?>
	</div>
<h3>Propietario</h3>
	<div class="form-inline">
			
			<img src='images/iconos/glyphicons/propietario.png'/>  <?php echo CHtml::dropDownList('idPropietario',$idPropietario,CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('prompt'=>'seleccione...','style'=>'width:250px;float:right','class'=>'chosen')); ?>
			
	</div>
</div>