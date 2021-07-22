<html>
<head>
<?php $tama=Settings::model()->getValorSistema('SIZE_EXPENSAS_FUENTE');?>
<style>
body 
{
	 font-family:Arial, Helvetica, sans-serif;
	
}
.tablaDatos{
	padding:10px;
    border-collapse:collapse;
    border-spacing:0;
    width:100%;
    border: 0px solid;
    font-family:Arial, Helvetica, sans-serif;

	font-size:<?=$tama;?>px;
}
table td {
	border-top: 1px solid #000;
	border-bottom:1px solid #000;
	border-left: 1px solid #000;
	border-right: 1px solid #000;
}
table th {
	border-top: 1px solid #000;
	border-bottom:1px solid #000;
	border-left: 1px solid #000;
	border-right: 1px solid #000;
}
</style>
</head>
<body>

<?=$data;?>

</body>
</html>