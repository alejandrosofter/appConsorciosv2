<div class="span3">
<h3>Locador <img src='images/iconos/glyphicons/inquilino.png'/> </h3>
	<div class="">
			
			<?php echo CHtml::dropDownList('idLocador',$idLocador,CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('prompt'=>'seleccione...','style'=>'width:250px','class'=>'chosen')); ?>
	</div>
<h3>Locatario <img src='images/iconos/glyphicons/propietario.png'/>  </h3>
	<div class="">
			
			
			<?php echo CHtml::dropDownList('idLocatario',$idLocatario,CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('prompt'=>'seleccione...','style'=>'width:250px','class'=>'chosen')); ?>
			
	</div>

</div>
<div class='span3'>
<h3>Garante 1 <img src='images/iconos/glyphicons/propietario.png'/>  </h3>
	<div class="">
			 
			<?php echo CHtml::dropDownList('garante1',$garante1,CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('prompt'=>'seleccione...','style'=>'width:250px','class'=>'chosen')); ?>
			
	</div>
<h3>Garante 2 <img src='images/iconos/glyphicons/propietario.png'/>  </h3>
	<div class="">
			<?php echo CHtml::dropDownList('garante2',$garante2,CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial'),array ('prompt'=>'seleccione...','style'=>'width:250px','class'=>'chosen')); ?>
			
	</div>
</div>