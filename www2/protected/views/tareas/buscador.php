<div  class="form-search">
  <?php 
$data = Edificios::model()->findAll();
$list = CHtml::listData($data,  'id', 'nombreEdificio');
echo CHtml::dropDownList('idEdificio', "",  $list, array('empty' => 'TODOS...',"onchange"=>"cambiaEdificio()","style"=>"width:120px"));
echo CHtml::dropDownList('estado', "PENDIENTE",  array('PENDIENTE' => 'PENDIENTE', 'REALIZADO' => 'REALIZADO'), array('empty' => 'TODOS...',"onchange"=>"cambiaEstado()","style"=>"width:120px"));
?> 
<a style="" onclick="buscar()" id="buscarButton" class="btn btn-primary"><i class=" icon-zoom-in icon-white"></i> Buscar</a>
</div>
