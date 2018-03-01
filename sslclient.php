<?php
/*
 *	$Id: sslclient.php,v 1.1 2004/01/09 03:23:42 snichol Exp $
 *
 *	SSL client sample.
 *
 *	Service: SOAP endpoint
 *	Payload: rpc/encoded
 *	Transport: https
 *	Authentication: none
 */
require_once('../lib/nusoap.php');
$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
$client = new nusoap_client('https://URL.asmx?wsdl', true,
						$proxyhost, $proxyport, $proxyusername, $proxypassword);
$client->setCredentials("", "", "certificate", array( 
	 'sslcertfile' => 'C:\\xampp\\htdocs\nusoap\\samples\\ClientCert.pem', 
	//'sslkeyfile' =>  'cert.p12', 
	'passphrase' => 'P2DvHtsarFcdK', 
	'verifypeer' => FALSE, 
	'verifyhost' => FALSE 
	)); 

	//var_dump($client);
	
$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

	$cadenaXML='<?xml version="1.0" encoding="UTF-8"?><rtas><rta><nroSolicitud>23</nroSolicitud><jefaturaDistrital>SCZ</jefaturaDistrital><nroRS>20</nroRS><gestion>2018</gestion><razonSocial>PRUEBA RAZON SOCIAL 20</razonSocial><nroPlaca>3938TIHG</nroPlaca><tipo>C</tipo><marca>NISSAN</marca></rta></rtas>';
	$parametros = array('xml'=> $cadenaXML);
  //$result = $client->call('getVersion', array(), 'http://arcweb.esri.com/v2', 'getVersion');
	$result = $client->call("GuardarRTA", $parametros);
	print_r($result);
	
if ($client->fault) {
	echo '<h2>Fault</h2><pre>'; print_r($result); echo '</pre>';
} else {
	$err = $client->getError();
	if ($err) {
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		
		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
	}
}

echo '<pre>';        
// wsdl methods
//print_r($client->getFunctions());        
echo '</pre>';
/*echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';*/
?>
