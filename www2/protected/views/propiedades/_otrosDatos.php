<div class='span3'>
        <?php echo $form->select2Row($model,'idUbicacion',array('data'=>CHtml::listData(Ubicaciones::model()->findAll(), 'id', 'nombreUbicacion')),array('class'=>'span4')); ?>

        <?php echo $form->select2Row($model,'idLocalidad',array('data'=>CHtml::listData(Localidades::model()->findAll(), 'id', 'nombreLocalidad')),array('class'=>'span3')); ?>
       <?php echo $form->textFieldRow($model,'provincia',array('class'=>'span2','maxlength'=>255)); ?>
       <?php echo $form->textFieldRow($model,'cantidadHabitacion',array('class'=>'span1','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'cantidadBano',array('class'=>'span1','maxlength'=>255)); ?>



    </div>
    <div class='span3'>
        <?php echo $form->textAreaRow($model,'mapsDireccion',array('class'=>'span4','style'=>'height:150px')); ?>
<?php echo $form->checkBoxRow($model,'tienePatio',array('class'=>'span1','maxlength'=>255)); ?>
<?php echo $form->checkBoxRow($model,'tieneQuincho',array('class'=>'span1','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'importe',array('class'=>'span1','maxlength'=>255)); ?>

    </div>