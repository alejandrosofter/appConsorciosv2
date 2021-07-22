<?php
$this->widget(
    'bootstrap.widgets.TbRedactorJs',
    array(
        'model' => $model,
        'attribute'=>'textoContrato',
        'htmlOptions'=>array('style'=>'width:100%')
    )
);
?>