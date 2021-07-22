<?php
    $tamFuente="1";
     header("Content-type: text/css");
?>
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

	font-size:<?=$tamFuente;?>px;
}
table td {
	border-top: 1px solid #000;
	border-bottom:1px solid #000;
	border-left: 1px solid #000;
}
table th {
	border-top: 1px solid #000;
	border-bottom:1px solid #000;
	border-left: 1px solid #000;
}