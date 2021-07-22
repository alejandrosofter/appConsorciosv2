<h1>Aplicar Gastos Frecuentes</h1>
Mediante esta interfaz ud. podrá agregar gastos automaticamente: <br>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'edificios-gastos-frecuentes-form','action'=>'index.php?r=edificiosGastosFrecuentes/cargarInfo',
    'enableAjaxValidation'=>false,
)); ?>
<table>
<tr>
    <td>
    Edificio <?php $this->widget('bootstrap.widgets.TbSelect2',array(
  'id'=>'idEdificio',
  'name'=>'idEdificio',
  'htmlOptions'=>array('onchange'=>'cambiaEdificio()'),
  'data'=>CHtml::listData(Edificios::model()->findAll(), 'id', 'nombreEdificio')
)); ?>
    </td>
    <td>
Fecha <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'fecha',
    'id'=>'fecha',
    'value'=>$fecha,
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'class'=>'span2'
    ),
)); ?>
</td>
</tr>
</table>


<h3>Gastos para Aplicar</h3>
<div id='paraLiquidar'></div>
<?php echo CHtml::submitButton('Aplicar',array('class'=>'btn btn-primary')); ?>
<?php $this->endWidget(); ?>
<script>
cambiaEdificio();

function cambiaEdificio()
{
	$.getJSON( "index.php?r=edificiosGastosFrecuentes/paraAplicar",{idEdificio:$('#idEdificio').val()}, function( data ) {
		$("#paraLiquidar").html(data.data);
		});
}
</script>