<?php
error_reporting(E_ALL);ini_set('error_reporting', E_ALL);ini_set('display_errors',1);
/*
$clienteOptions =array("trace"  => true, 
                        "exceptions"    => true, 
                        "local_cert"    => "../wscliente/Llaves/gobscz/trazcruzgobbo.pem",//."ClienteCertPEM.pem", //trazacruzsantacruzgobbo.pem
                        //"passphrase" => 'P2DvHtsarFcdK',
                        "style"         => SOAP_RPC,
                        "use"           => SOAP_ENCODED,
                        "soap_version"  => SOAP_1_2 ,
                        "cache_wsdl" => WSDL_CACHE_NONE,
                        "location"      => "https://181.188.148.19/ws/WebTrazacruz.asmx"
                        );
*/
$clienteOptions =array("trace"  => true, 
                        "exceptions"    => true, 
                        //"local_cert"    => "C:\\xampp\\htdocs\\pruebaphp\\CertCliente\\ClientCert.pfx",//."ClienteCertPEM.pem", //trazacruzsantacruzgobbo.pem
                        //'passphrase' => 'P2DvHtsarFcdK',
                        "style"         => SOAP_RPC,
                        "use"           => SOAP_ENCODED,
                        "soap_version"  => SOAP_1_2 ,
                        "cache_wsdl" => WSDL_CACHE_NONE,
                        "location"      => "http://URL.asmx"
                        ); 
//"location"      => "https://181.188.148.19/ws/WebTrazacruz.asmx"
$cadenaXML='<rtas>
	<rta><nroSolicitud>23</nroSolicitud><jefaturaDistrital>SCZ</jefaturaDistrital><nroRS>20</nroRS><gestion>2018</gestion><razonSocial>PRUEBA RAZON SOCIAL 20</razonSocial><nroPlaca>3938TIH</nroPlaca><tipo>C</tipo><marca>NISSAN</marca></rta></rtas>';     
try{

            $clienteSOAP = new SoapClient("http://URL.asmx?wsdl",$clienteOptions);            
            $parametros = array('xml'=>$cadenaXML);
            $resultadoObject  = $clienteSOAP->GuardarRTA($parametros);

            echo '<pre>';        
            // wsdl methods
            print_r($clienteSOAP->__getFunctions());        
            echo '</pre>';
        }catch(Exception $e){
            echo $e->getMessage();
        }
        //echo $resultadoObject;
        
?>