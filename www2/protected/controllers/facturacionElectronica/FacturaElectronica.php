<?PHP
define ("WSDL_FA",  dirname(__FILE__)."/resources/wsfev1.wsdl");          # The WSDL corresponding to WSFEX
          # CUIT del emisor de las FC/NC/ND

#define ("URLFA", "https://wswhomo.afip.gov.ar/wsfev1/service.asmx");
define ("URLFA", "https://servicios1.afip.gov.ar/wsfev1/service.asmx");
include_once("TicketAcceso.php");
class FacturaElectronica
{
  private $sign;
  private $token;
  private $client; 
  private $idTalonario;
  public function __construct($cert,$pk,$idTal)
  {
    ini_set("soap.wsdl_cache_enabled", "0"); 
    $t=new TicketAcceso($cert,$pk,$idTal);
    $this->idTalonario=$idTal;
  }
  private function autoriza()
  {
    $client=new SoapClient(WSDL_FA, array(
                //'proxy_host'     => PROXY_HOST,
                //'proxy_port'     => PROXY_PORT,
                'soap_version'   => SOAP_1_2,
                'location'       => URLFA,
                'trace'          => 1,
                'exceptions'     => 0
                ));
    $TA=simplexml_load_file(TA.$this->idTalonario);
    $this->token=$TA->credentials->token;
    $this->sign=$TA->credentials->sign;
    $this->client=$client;
  }
  //Ingreso de factura
public function ingresarFactura ($cuit,$PUNTOVENTA,$TIPOCOMPROBANTE, $datosFactura,$cantidadRegistros)
{
  $this->autoriza();

  $sol=array('Auth' => array(
             'Token' => $this->token,
             'Sign'  => $this->sign,
             'Cuit'  => $cuit),
             'FeCAEReq' => array(
             'FeCabReq' => array(
                'CantReg' => 1, //1
                'PtoVta' => $PUNTOVENTA,
                'CbteTipo' => $TIPOCOMPROBANTE
                 ),
             'FeDetReq' => array(
                'FECAEDetRequest' => $datosFactura
                 )
          )
          );
  $results=$this->client->FECAESolicitar($sol);
  file_put_contents(dirname(__FILE__)."/resources/request-AUTCms.xml",$this->client->__getLastRequest());
  file_put_contents(dirname(__FILE__)."/resources/response-AUTCms.xml",$this->client->__getLastResponse());
  $this->CheckErrors($results, 'FECAESolicitar', $this->client);

  return($results->FECAESolicitarResult);
}
public function puntosVenta ($cuit)
{
  $this->autoriza();
  $results=$this->client->FEParamGetPtosVenta(
    array('Auth' => array(
             'Token' => $this->token,
             'Sign'  => $this->sign,
             'Cuit'  => $cuit)
          )
          );
  $this->CheckErrors($results,'FEParamGetPtosVenta',$this->client);
  return $results;
}
public function proximoAutorizar ($puntoVenta,$tipoComp,$cuit)
{
  $this->autoriza();
 $results=$this->client->FECompUltimoAutorizado(
    array('Auth' => array(
             'Token' => $this->token,
             'Sign'  => $this->sign,
             'Cuit'  => $cuit),
          'PtoVta'=>$puntoVenta,
          'CbteTipo'=>$tipoComp
          )
          );
  $this->CheckErrors($results,'FECompUltimoAutorizado',$this->client);
  return $results->FECompUltimoAutorizadoResult->CbteNro;
}
  
  function CheckErrors($results, $method, $client)
  {
    if (LOG_XMLS)
    {
      file_put_contents(dirname(__FILE__)."/resources/request-".$method.".xml",$client->__getLastRequest());
      file_put_contents(dirname(__FILE__)."/resources/hdr-request-".$method.".txt",$client->
           __getLastRequestHeaders());
      file_put_contents(dirname(__FILE__)."/resources/response-".$method.".xml",$client->__getLastResponse());
      file_put_contents(dirname(__FILE__)."/resources/hdr-response-".$method.".txt",$client->
           __getLastResponseHeaders());
    }
    if (is_soap_fault($results)) 
    { 
      printf("Fault: %s\nFaultString: %s\n",
              $results->faultcode, $results->faultstring); 
      exit (1);
    }
  }
  public function tipoComprobantes($cuit='')
  {
      $this->autoriza();
      $xml = $this->geTipos($cuit);
      if(!isset($xml->FEParamGetTiposCbteResult->ResultGet)){
        print_r($xml->FEParamGetTiposCbteResult);
        return;
      }
      $x=($xml->FEParamGetTiposCbteResult->ResultGet);
      echo '<h1>TIPO DE COMPROBANTES HABILITADOS:</h1>';
      foreach($xml->FEParamGetTiposCbteResult->ResultGet as $it)
          foreach($it as $item){
        echo('<b>'.$item->Id.'</b> '.$item->Desc.' <small>'.$item->FchDesde.' '.$item->FchHasta.'</small><br>');

      }
      return $xml;
     
  }
  private function geTipos( $cuit)
  {
  
      $results=$this->client->FEParamGetTiposCbte (
      array('Auth' => array(
               'Token' => $this->token,
               'Sign'  => $this->sign,
               'Cuit'  => $cuit+'')
            )
            );
    $this->CheckErrors($results, 'FEParamGetTiposCbte', $this->client);

    return($results);
  }

}

?>