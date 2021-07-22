<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>


	<span>
	<?php echo CHtml::dropDownList('idTipoOperacion',isset($_GET['idTipoOperacion'])?$_GET['idTipoOperacion']:'',CHtml::listData(TipoOperaciones::model()->findAll(),'id','nombreTipoOperacion'),array('class'=>'span2','prompt'=>'todos...')); ?>
	<?=$form->textField($model,'buscar',array('class'=>'span3','placeholder'=>'Buscador','maxlength'=>255,'rel'=>'tooltip', 'title'=>'Puede buscar mediante cualquier campo de Comprobantes'));?>		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</span>

<?php $this->endWidget(); ?>

<script>
$('#Comprobantes_buscar').tooltip();
</script>