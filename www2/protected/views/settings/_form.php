<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>


		<?php echo $form->textField($model,'category',array('TYPE'=>'hidden','maxlength'=>64)); ?>

		<?php echo $form->textField($model,'key',array('TYPE'=>'hidden','maxlength'=>255)); ?>
        <b>KEY </b><?php echo $model->key; ?>
	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('class'=>'span6','rows'=>5)); ?>
	
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    "model"=>$model,                # Data-Model
    "attribute"=>'value',         # Attribute in the Data-Model
    "height"=>'500px',
    "width"=>'100%',
   // "toolbarSet"=>'Full',          # EXISTING(!) Toolbar (see: fckeditor.js)
    "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                                    # Path to fckeditor.php
    "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                                    # Realtive Path to the Editor (from Web-Root)
    
                                    # http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
                                    # Additional Parameter (Can't configure a Toolbar dynamicly)
    ) ); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>


	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->