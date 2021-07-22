<?php
$this->breadcrumbs=array(
	'Configuraciones'=>array(''),
);

?>

<h1>Variables del Usuario</h1>
A traves de esta interfaz ud. podra modificar valores del sistema que alteran su funcionamiento en distintas areas:
<br><br>
<div class='form'>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); 
//$this->widget('ext.bootstrap.widgets.BootAlert',array(
//    'id'=>'alert',
//    'keys'=>array('success','info','warning','error'),
//));
        ?>

<?php
$this->renderPartial('_variablesUsuario',array(),false);



?>
	
	
	
	
	<div class="actions">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>