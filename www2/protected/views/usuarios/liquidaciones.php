<?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); ?>
<div class="panel-group" id="accordion">
<?php 
foreach(Propiedades::model()->propiedadesEntidad(Yii::app()->user->id) as $propiedad){?>
<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?=$propiedad->id?>">
          <?=$propiedad->nombrePropiedad?> - <small><?=$propiedad->edificio->nombreEdificio?></small>
        </a>
      </h4>
    </div>
    <div id="collapseOne_<?=$propiedad->id?>" class="panel-collapse collapse in">
      <div class="panel-body">
        <?=$this->renderPartial('liquidacionPropiedad',array('idEdificio'=>$propiedad->idEdificio));?>
      </div>
    </div>
  </div>


<?php }


?>
</div>
<?php $this->endWidget(); ?>