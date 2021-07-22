
<?php
# Author: Gerardo Fisanotti - DvSHyS/DiOPIN/AFIP - 13-apr-07
# Function: Get an authorization ticket (TA) from AFIP WSAA
# Input:
#        WSDL, CERT, PRIVATEKEY, PASSPHRASE, SERVICE, URL
#        Check below for its definitions
# Output:
#        TA.xml: the authorization ticket as granted by WSAA.
#==============================================================================
define ("WSDL", dirname(__FILE__)."/resources/wsaa.wsdl");     # The WSDL corresponding to WSAA
define ("TRA", dirname(__FILE__)."/resources/TRA.xml");
define ("TA", dirname(__FILE__)."/resources/TA.xml");               # Ticket de Acceso, from WSAA
define ("TRA_TMP", dirname(__FILE__)."/resources/TRA.tmp");
define ("LOG_XMLS", TRUE);              # For debugging purposes

define ("PASSPHRASE", "idAlerta"); # The passphrase (if any) to sign
define ("PROXY_HOST", "10.20.152.112"); # Proxy IP, to reach the Internet
define ("PROXY_PORT", "80");            # Proxy TCP port
#define ("URL", "https://wsaahomo.afip.gov.ar/ws/services/LoginCms");

define ("URL", "https://wsaa.afip.gov.ar/ws/services/LoginCms");
#------------------------------------------------------------------------------
# You shouldn't have to change anything below this line!!!
#==============================================================================
class TicketAcceso
{

      public function __construct($cert,$pk,$idTalonario)
      {
          ini_set("soap.wsdl_cache_enabled", "0");
          if (!file_exists($cert)) {exit("Failed to open ".$cert."\n");}
          if (!file_exists($pk)) {exit("Failed to open ".$pk."\n");}
          if (!file_exists(WSDL)) {exit("Failed to open ".WSDL."\n");}

          $SERVICE='wsfe';

          $cache_life = 60*60*2; //caching time, in seconds
          $ahora=strtotime(Date('Y-m-d H:i:s'));
          $filemtime = @filemtime(TA.$idTalonario);
          $dife=$ahora-$filemtime;
          if($dife>1000){
              $this->CreateTRA($SERVICE);
              $CMS=$this->SignTRA($cert,$pk);
              $TA=$this->CallWSAA($CMS);
              if (!file_put_contents(TA.$idTalonario, $TA)) {exit();}
          }
          
      }
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
        $TRA->asXML(TRA);
      }
      #==============================================================================
      # This functions makes the PKCS#7 signature using TRA as input file, CERT and
      # PRIVATEKEY to sign. Generates an intermediate file and finally trims the 
      # MIME heading leaving the final CMS required by WSAA.
      private function SignTRA($cert,$pk)
      {
        $STATUS=openssl_pkcs7_sign(TRA, TRA_TMP, "file://".$cert,
          array("file://".$pk, PASSPHRASE),
          array(),
          !PKCS7_DETACHED
          );
        if (!$STATUS) {exit("ERROR generating PKCS#7 signature\n");}
        $inf=fopen(TRA_TMP, "r");
        $i=0;
        $CMS="";
        while (!feof($inf)) 
          { 
            $buffer=fgets($inf);
            if ( $i++ >= 4 ) {$CMS.=$buffer;}
          }
        fclose($inf);
      #  unlink("TRA.xml");
        unlink(TRA_TMP);
        return $CMS;
      }
      #==============================================================================
      private function CallWSAA($CMS)
      {
        $client=new SoapClient(WSDL, array(
                //'proxy_host'     => PROXY_HOST,
                //'proxy_port'     => PROXY_PORT,
                'soap_version'   => SOAP_1_2,
                'location'       => URL,
                'trace'          => 1,
                'exceptions'     => 0
                )); 
        $results=$client->loginCms(array('in0'=>$CMS));
        file_put_contents(dirname(__FILE__)."/resources/request-loginCms.xml",$client->__getLastRequest());
        file_put_contents(dirname(__FILE__)."/resources/response-loginCms.xml",$client->__getLastResponse());
        if (is_soap_fault($results)) 
          {exit("SOAP Fault: ".$results->faultcode."\n".$results->faultstring."\n");}
        
        return $results->loginCmsReturn;
      }
}
#==============================================================================

?>
