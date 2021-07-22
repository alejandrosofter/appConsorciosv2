<div class='span3'>
<?php echo $form->select2Row($model,'idEdificio',array('htmlOptions'=>array('onchange'=>'cambia()'),'options'=>array('placeholder'=>'Seleccione...','allowClear'=>true),'data'=>CHtml::listData(Edificios::model()->findAll(), 'id', 'nombreEdificio')),array('class'=>'span4')); ?>

        <?php echo $form->textFieldRow($model,'nombrePropiedad',array('class'=>'span3','maxlength'=>255)); ?>
<?php echo $form->checkBoxRow($model,'tieneCochera',array('class'=>'span1','onchange'=>'cambiaCochera()','maxlength'=>255)); ?>
<div id='tieneCochera'><?php echo $form->textFieldRow($model,'porcentajeCochera',array('class'=>'span1','maxlength'=>255)); ?></div>
        <?php echo $form->select2Row($model,'idTipoPropiedad',array('data'=>CHtml::listData(PropiedadesTipos::model()->findAll(), 'id', 'nombreTipoPropiedad')),array('class'=>'span4')); ?>

        <?php echo $form->listBoxRow($model,'estado',Propiedades::model()->getEstados(),array('class'=>'span3')); ?>


    </div>
    <div class='span3'>
    <?php echo $form->select2Row($model,'idEntidadPaga',array('options'=>array('placeholder'=>'Seleccione...','allowClear'=>true),'data'=>CHtml::listData(Entidades::model()->findAll(), 'id', 'razonSocial')),array('class'=>'span4')); ?>

        <?php echo $form->textFieldRow($model,'domicilio',array('class'=>'span3','maxlength'=>255)); ?>
         <?php echo $form->textFieldRow($model,'ordenamiento',array('class'=>'span1','maxlength'=>255)); ?>
         <?php echo $form->textFieldRow($model,'porcentaje',array('class'=>'span1','maxlength'=>255)); ?>

        <?php echo $form->textAreaRow($model,'detalle',array('class'=>'span3','rows'=>3,'maxlength'=>255)); ?>
      
       <?php echo $form->textFieldRow($model,'importeFavor',array('class'=>'span1','maxlength'=>255)); ?>
    </div>
    <div class='span4'>
    <?php $this->renderPartial('/propiedadesEntidades/_form2',array('idInquilino'=>$idInquilino,'idPropietario'=>$idPropietario));?>
    </div>
<script>
checkTiene();
function cambiaCochera()
{
	checkTiene();
}
function checkTiene()
{
    var cochera=$( "#Propiedades_tieneCochera" ).attr('checked');
    if(cochera=='checked')$('#tieneCochera').show();else $('#tieneCochera').hide();
}
</script>