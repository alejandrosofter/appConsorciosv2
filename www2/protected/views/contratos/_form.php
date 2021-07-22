<div class='row'>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contratos-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son requeridos</p>

<?php echo $form->errorSummary($model); ?>
<?php
$gral=$this->renderPartial('_form2', array('model'=>$model,'items'=>$items,'form'=>$form),true);
$impre=$this->renderPartial('_impresion', array('model'=>$model,'items'=>$items,'form'=>$form),true);
$tabs=array(
     array('label' => 'Datos Grales', 'content' =>$gral,'active'=>true),
     // array('label' => 'Impresion', 'content' =>$impre)
      );
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs',
        'tabs' => $tabs
    )
);
?>
</div>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'htmlOptions'=>array('data-loading-text'=>'Cargando...'),
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
<script>
function cambiaFecha()
  {
  	var meses=diferenciaFechas($('#Contratos_fechaInicio').val(),$('#Contratos_fechaVencimiento').val(),'yyyy-mm-dd','-',true);
  	
  	$('#Contratos_cuota').val(meses.months);
  }
</script>