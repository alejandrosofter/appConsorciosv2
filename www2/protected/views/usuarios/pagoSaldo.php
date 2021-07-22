<?php

//**********************ID VENTA************************************//
$data=file_get_contents('estado');
$arrData=explode(';',$data);
$idVenta=$arrData[0];
//**********************ID VENTA************************************//


//**********************INTERFAZ MP************************************//
require_once dirname(__FILE__)."/../../extensions/MP/mercadopago.php";
$mp = new MP('5839987130287087', 'v5vbB8PyLJy7l48TH8zWjbyHKSWpthBF');
$mp->sandbox_mode(TRUE);
$preference_data = array(
    "items" => array(
       array(
           "title" => "Servicio Sistemas YAVU",
           "quantity" => 1,
           "currency_id" => "ARS",
           "unit_price" => -$saldo
       )
    ),
    "external_reference" => $idVenta,
);

$preference = $mp->create_preference($preference_data);
$preference['response']['sandbox_init_point'];
//**********************INTERFAZ MP************************************//
?>
<a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="blue-ar-m-rn-arall">Pagar</a>
		<script type="text/javascript" src="http://mp-tools.mlstatic.com/buttons/render.js"></script>