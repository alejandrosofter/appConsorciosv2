<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<link rel="stylesheet" type="text/css" href="css/style.css">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/printThis/printThis.js', CClientScript::POS_HEAD); ?>
<style>
{
   font-size: 50%;
}
</style>
</head>

<body>
  <?php
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
    echo '<div style="float:center">';
    foreach($flashMessages as $key => $message) {
        echo '<div class="alert in fade alert-' . $key . '">' . $message . ' <a href="#" class="close" data-dismiss="alert">×</a></div>';
    }
    echo '</div>';
}

?>
<script>
function imprimirPapel(debugFalg)
{
    $(".impresionPapel").printThis({
      debug: debugFalg,             
      importCSS: false,           
      printContainer: false,      
      pageTitle: "",             
      removeInline: true        
  });
}
</script>
<div class="container-fluid">
	<?php echo $content; ?>
</div>
<script>
$(document).keypress(function(e) {
  if(e.which == 13) {
    imprimirPapel();
  }
});
</script>
</body>
</html>