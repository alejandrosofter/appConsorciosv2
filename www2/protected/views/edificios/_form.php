<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'edificios-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model);
$dataGeneral=$this->renderPartial('_formData',array('model'=>$model,'form'=>$form),true);
$dataEditor=$this->renderPartial('_editor',array('model'=>$model,'form'=>$form),true);
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
        	
        	 array(
                'label' => 'General',
                'content' => $dataGeneral,
                'active'=>true
            ),
            
            array('label' => 'Datos del Consorcio', 'content' => $dataEditor),
        ),
    )
);
 ?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'htmlOptions'=>array('data-loading-text'=>'Cargando...'),
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
