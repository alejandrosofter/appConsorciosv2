<?php
    header("Content-type: text/css; charset: UTF-8");
    $tamFuente= $_GET['tam'];
?>
table{
	font-size: <?=$tamFuente?>px;
	font-family: "arial";
	border-collapse: collapse;
	 border-style: solid;
	 border: 1px solid black;
}