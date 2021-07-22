<div class="form">
    <h1>Nueva Tarea Programada</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo CHtml::textField('cron','',array('TYPE'=>'hidden','maxlength'=>64)); ?>
	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>




	<div class="row">
		Minutos
		<?php echo CHtml::textField('minutos','*',array('class'=>'span1','maxlength'=>64)); ?>
                Horas
		<?php echo CHtml::textField('horas','*',array('class'=>'span1','maxlength'=>64)); ?>
                Dias
		<?php echo CHtml::textField('dias','*',array('class'=>'span1','maxlength'=>64)); ?>
                Meses
		<?php echo  CHtml::dropDownList('meses','',Settings::model()->getMeses());?>
                Dias Semana
		<?php echo  CHtml::dropDownList('diasSemana','',Settings::model()->getDiasSemana());?>
		
	
		
		
		
	</div>
<span class='help-block'><b>NOTA: </b>Desactiva o Activa las alertas de las ordenes para el módulo de Servicios .</span>
	<div class="actions">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->