<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>$campo,
    'model'=>$model,
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions'=>array(
    	'class'=>'span2'
    ),
)); ?>