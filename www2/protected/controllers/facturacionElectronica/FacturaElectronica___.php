<?PHP
class FacturaElectronica
{
	static $WSDL ; 
	static $CERT = ''; 
  static $PUNTOVENTA = '';
  static $TIPOCOMPROBANTE = ''; 
	const PASSPHRASE = 'idAlerta'; 
	static $PRIVATEKEY = ''; 
  static $CUIT='';
	const PROXY_HOST = 'localhost'; 
	const PROXY_PORT = '80'; 
  const URL = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms"; 
  //const URL = "https://wsaa.afip.gov.ar/ws/services/LoginCms"; 
	const TRA = 'TRA.xml'; 
	const TRA_TEMP = 'TRA.tmp'; 
	
	//CONSTANTES DE ACCESO
	static $WSDL_CLIENTE ; 
	const TA = 'TA.xml'; 
  const WSFEURL = 'https://wswhomo.afip.gov.ar/wsfev1/service.asmx'; 
  //const WSFEURL = 'https://servicios1.afip.gov.ar/wsfev1/service.asmx';
	const PROXY_HOST_CLIENTE = 'localhost'; 
	const PROXY_PORT_CLIENTE = '80'; 
	const LOG_XMLS = true; 
        
  public function __construct($pk,$urlCertificado,$cuit,$puntoVenta,$tipoComp)
  {
    ini_set("soap.wsdl_cache_enabled", "0");
    self::$CERT=$urlCertificado;
    self::$PRIVATEKEY=$pk;
    self::$PUNTOVENTA=$puntoVenta;
    self::$TIPOCOMPROBANTE=$tipoComp;
    self::$CUIT=$cuit;
    self::$WSDL=dirname(__FILE__). '/resources/wsaa.wsdl';
    self::$WSDL_CLIENTE=dirname(__FILE__).'/resources/wsfev1.wsdl';   
    
  }
	public function iniciar()
  {
    $this->activarWs();
   
  }
  //Activa con el TA el acceso
  public function activarWs($SERVICE='wsfe')
  {
    
    if (!file_exists(self::$CERT)) {exit("Error para abrir ".self::$CERT."\n");}
    if (!file_exists(self::$PRIVATEKEY)) {exit("Error para abrir ".self::$PRIVATEKEY."\n");}
    if (!file_exists(self::$WSDL)) {exit("Error para abrir ".self::WSDL."\n");}
    
    $cache_life = 60*60*2; //caching time, in seconds
    $ahora=strtotime(Date('Y-m-d H:i:s'));
    $filemtime = @filemtime(self::TA);
    $dife=$ahora-$filemtime;
    echo 'ACTIVANDO EL SERVICIO '.$SERVICE.'<BR>';
   
      $CMS=$this->SignTRA($SERVICE);
      $TA=$this->CallWSAA($CMS);
      echo('fdsfsd');
    
    
    
  }
  //Crea el Ticket Request Acces
  private function CreateTRA($SERVICE)
  {
    $TRA = new SimpleXMLElement(
      '<?xml version="1.0" encoding="UTF-8"?>' .
      '<loginTicketRequest version="1.0">'.
      '</loginTicketRequest>');
    $TRA->addChild('header');
    $TRA->header->addChild('uniqueId',date('U'));
    $TRA->header->addChild('generationTime',date('c',date('U')-60));
    $TRA->header->addChild('expirationTime',date('c',date('U')+60));
    $TRA->addChild('service',$SERVICE);
    $TRA->asXML(self::TRA);
  }
// 4029172653638003
  //0215
  //362

  //4508330005647847
  //0617
  //259
  //Firma digitalmente el Acceso
  private function SignTRA($SERVICE)
  {
    //error_reporting(E_ERROR);
    $this->CreateTRA($SERVICE);
    
      $STATUS=openssl_pkcs7_sign(self::TRA, self::TRA_TEMP, "file://".self::$CERT,
      array("file://".self::$PRIVATEKEY, self::PASSPHRASE),
      array(),!PKCS7_DETACHED);


    if (!$STATUS) {exit("ERROR para generar la FIRMA, por favor verificar que el certificado, el pedido.csr y el llave.key coincidan. ");}
    $inf=fopen(self::TRA_TEMP, "r");
    $i=0;
    $CMS="";
    while (!feof($inf))
      { 
        $buffer=fgets($inf);
        if ( $i++ >= 4 ) {$CMS.=$buffer;}
      }
    fclose($inf);
    unlink(self::TRA_TEMP);
    return $CMS;
  }
function CallWSAA($CMS)
{
  $client=new SoapClient(self::$WSDL, array(
          'soap_version'   => SOAP_1_2,
          'location'       => self::$WSFEURL,
          'trace'          => 1,
          'exceptions'     => 0
          )); 
  $results=$client->loginCms(array('in0'=>$CMS));
  file_put_contents("request-loginCms.xml",$client->__getLastRequest());
  file_put_contents("response-loginCms.xml",$client->__getLastResponse());
  if (is_soap_fault($results)) 
    {exit("SOAP Fault: ".$results->faultcode."\n".$results->faultstring."\n");}
  return $results->loginCmsReturn;
}
  //Realiza el enlace con el WS
  private function CallWSAA2($CMS)
  {
    $client=$this->conectarCliente(self::$WSDL);
    
    $results=$client->loginCms(array('in0'=>$CMS));
    file_put_contents("request-loginCms.xml",$client->__getLastRequest());
    file_put_contents("response-loginCms.xml",$client->__getLastResponse());
    $error="";
    if (is_soap_fault($results)) 
      {
      	switch ($results->faultcode)
      	{
      		case 'HTTP':{
      			$error='No hay conexión a internet, por favor chequee y vuelva a internarlo';
      		}
      		
      	}
        print_r($results->faultcode);
        if($results->faultcode=="ns1:cms.cert.untrusted")
          echo "En WSAA, descartando que se este usando el certificado del ambiente incorrecto (certificado de homologación en producción y viceversa), es necesario que el certificado y CUIT estén habilitados para acceder al servicio web especificado (wsfe, wsfex, wsbfe, wsctg, wDigDepFiel, etc.). No es suficiente generar el certificado (en homologación o en producción), hay que solicitar explicitamente acceso al servicio requerido: ver Asociación de Certificado

Los servicios no relacionados a factura electrónica, en producción tienen otros métodos para asociar los certificados.

Ver Comprobación de Autenticación WSAA con información para determinar o depurar el problema de acceso.

Mensajes de Error Original:<br>

Computador no autorizado a acceder los servicios de AFIP (ns1:coe.notAuthorized)<br>
Certificado no emitido por AC de confianza (ns1:cms.cert.untrusted)".'<br>';
        exit(1);
      }
        return $client;
  }
  private function conectarCliente($WSDL)
  {
      try{
         
        $client=new SoapClient(self::$WSDL, 
        array('soap_version' => SOAP_1_2,
              'location'     => self::WSFEURL,
              #'proxy_host'   => PROXY_HOST,
              #'proxy_port'   => PROXY_PORT,
              'exceptions'   => 0,
              'trace'        => 1)); 
        } catch (Exception $e) {
          echo 'no se puede conectar';
        }
      return $client;
  }

  

//Checkea errores
public function CheckErrors($results, $method, $client)
{
    
//   $r=new SimpleXMLElement($results);
      
    file_put_contents("error.xml",$results);
  if (is_soap_fault($results))
  { 
    echo $results->faultstring.'--';
    printf("ERROR: %s\nFaultString: %s\n",
            $results->faultcode, $results->faultstring);
    exit (1);
  }

  $XXX=$method.'Result';
  if (isset($results->$XXX->Errors))
    {
//      printf("Methodo=%s\n",$method);
//      printf("Nro Error=%s\n",$results->$XXX->Errors->Err->Code);
//      printf("Mensaje=%s\n",$results->$XXX->Errors->Err->Msg);
        echo ($results);
        exit (1);
    }
}
private function consultarUltima($client, $token, $sign, $cuit,$puntoVenta,$tipoComp)
{
    $results=$client->FECompUltimoAutorizado(
    array('Auth' => array(
             'Token' => $token,
             'Sign'  => $sign,
             'Cuit'  => $cuit+''),
             'PtoVta' => $puntoVenta,
             'CbteTipo' => $tipoComp
       
          
          )
          );
  $this->CheckErrors($results, 'FECompUltimoAutorizado', $client);

  return $results->FECompUltimoAutorizadoResult->CbteNro;
}
//Ingreso de factura
private function Aut ($client, $token, $sign, $cuit, $datosFactura,$cantidadRegistros)
{
  $results=$client->FECAESolicitar(
    array('Auth' => array(
             'Token' => $token,
             'Sign'  => $sign,
             'Cuit'  => $cuit),
             'FeCAEReq' => array(
             'FeCabReq' => array(
                'CantReg' => $cantidadRegistros, //1
                'PtoVta' => self::$PUNTOVENTA,
                'CbteTipo' => self::$TIPOCOMPROBANTE
                 ),
             'FeDetReq' => array(
                'FECAEDetRequest' => $datosFactura
                 )
          )
          )
          );
  file_put_contents("request-AUTCms.xml",$client->__getLastRequest());
  file_put_contents("response-AUTCms.xml",$client->__getLastResponse());
  $this->CheckErrors($results, 'FECAESolicitar', $client);
  
  $salida['CAE']=$results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAE;
  $salida['CAEFchVto']=$results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAEFchVto;
  $salida['Events']=isset($results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Events)?$results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Events:"";
  $salida['Errors']=isset($results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Errors)?$results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Errors:'';
  
  return $salida;
}

//Ingresa una factura
  private function ingresaFactura($datosFactura,$cantidadItems)
  {
  	if (!file_exists(self::$WSDL_CLIENTE)) {exit("Error para abrir ".self::$WSDL_CLIENTE."\n");}
  	if (!file_exists(self::TA)) {exit("Error para abrir ".self::TA."\n");}

  	$client=new SoapClient(self::$WSDL_CLIENTE, 
  	  array('soap_version' => SOAP_1_2,
  	        'location'     => self::WSFEURL,
  	       'proxy_host'   => PROXY_HOST,
  	       'proxy_port'   => PROXY_PORT,
  	        'exceptions'   => 0,
  	        'trace'        => 1)); 
  	$TA=simplexml_load_file(self::TA);
  	$token=$TA->credentials->token;
  	$sign=$TA->credentials->sign;
  	file_put_contents("request-AUTCms.xml",$client->__getLastRequest());
    file_put_contents("response-AUTCms.xml",$client->__getLastResponse());
  	return $this->Aut($client, $token, $sign, self::$CUIT,$datosFactura,$cantidadItems);

  }
  public function ingresarFactura($factura,$cantidadRegistros)
  {
  	//$this->activarWs();
  	return $this->ingresaFactura($factura,$cantidadRegistros);
  }

  public function init()
  {
  //        $this->ingresarFactura();
  //        echo $this->nroUltimo($this->getFact(),self::$CUIT);
          
  }
  public function nroUltimo($puntoVenta,$tipoComp,$cuit='')
  {
      $this->activarWs();
      if (!file_exists(self::$WSDL_CLIENTE)) {exit("Error para abrir ".self::$WSDL_CLIENTE."\n");}
  	if (!file_exists(self::TA)) {exit("Error para abrir ".self::TA."\n");}

  	$client=new SoapClient(self::$WSDL_CLIENTE, 
  	  array('soap_version' => SOAP_1_2,
  	        'location'     => self::WSFEURL,
  	       'proxy_host'   => PROXY_HOST,
  	       'proxy_port'   => PROXY_PORT,
  	        'exceptions'   => 0,
  	        'trace'        => 1)); 
  	$TA=simplexml_load_file(self::TA);
  	$token=$TA->credentials->token;
  	$sign=$TA->credentials->sign;
  	
     $res= $this->consultarUltima($client, $token, $sign, $cuit,$puntoVenta,$tipoComp);
     return  (int)$res+1;
  }
  public function tipoComprobantes($cuit='')
  {
      $this->activarWs();
      if (!file_exists(self::$WSDL_CLIENTE)) {exit("Error para abrir ".self::$WSDL_CLIENTE."\n");}
  	  if (!file_exists(self::TA)) {exit("Error para abrir ".self::TA."\n");}

    	$client=$this->conectarCliente(self::$WSDL_CLIENTE);
    	$TA=simplexml_load_file(self::TA);
    	$token=$TA->credentials->token;
    	$sign=$TA->credentials->sign;
  	
      $xml = ($this->geTipos($client, $token, $sign, self::$CUIT));
      
      $arr=$xml->FEParamGetTiposCbteResult->ResultGet->CbteTipo;
      echo '<h1>TIPO DE COMPROBANTES HABILITADOS:</h1>';
      foreach($arr as $item){
        echo('<b>'.$item->Id.'</b> '.$item->Desc.' <small>'.$item->FchDesde.' '.$item->FchHasta.'</small><br>');

      }
      return $xml;
     
  }
  
  private function geTipos($client, $token, $sign, $cuit)
  {
  
      $results=$client->FEParamGetTiposCbte(
      array('Auth' => array(
               'Token' => $token,
               'Sign'  => $sign,
               'Cuit'  => $cuit+'')
            )
            );
    $this->CheckErrors($results, 'FEParamGetTiposCbte', $client);

    print_r($results);
  }

}


?>