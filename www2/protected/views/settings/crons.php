<?php
if(isset($crons))
foreach ($crons as $cron)
    echo $cron;
else echo '<i>No hay ninguna tarea programada! </i><br>';
    
echo CHtml::link(CHtml::image('images/iconos/famfam/add.png').'Nueva Tarea Programada','index.php?r=settings/newCron');
?>
