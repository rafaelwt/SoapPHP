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

$arrContextOptions=array("ssl"=>array( "verify_peer"=>false, "verify_peer_name"=>false,'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT));
$clienteOptions =array("trace"  => true, 
                        "exceptions"    => true, 
                        "local_cert"    => "Certificado/ClientCert.pem",//."ClienteCertPEM.pem", //trazacruzsantacruzgobbo.pem
                        'passphrase' => 'P2DvHtsarFcdK',
                        "style"         => SOAP_RPC,
                        "use"           => SOAP_ENCODED,
                        "soap_version"  => SOAP_1_2 ,
                        "cache_wsdl" => WSDL_CACHE_NONE,
                        "location"      => "https://URL.asmx?wsdl",
                        'stream_context' => stream_context_create($arrContextOptions)
                        ); 
//"location"      => "https://181.188.148.19/ws/WebTrazacruz.asmx"
$cadenaXML='<?xml version="1.0" encoding="UTF-8"?><rtas><rta><nroSolicitud>31</nroSolicitud><jefaturaDistrital>SCZ</jefaturaDistrital><nroRS>20</nroRS><gestion>2018</gestion><razonSocial>PRUEBA RAZON SOCIAL 20</razonSocial><nroPlaca>3938TIHG</nroPlaca><tipo>C</tipo><marca>NISSAN</marca></rta></rtas>';
try{

            //libxml_disable_entity_loader(false); //adding this worked for me
            $clienteSOAP = new SoapClient("https://URL.asmx?wsdl",$clienteOptions);       
            
            echo '<pre>';        
            // wsdl methods
           // print_r($clienteSOAP->getFunctions());        
            echo '</pre>';
            $parametros = array('xml'=>$cadenaXML);
            $resultadoObject  = $clienteSOAP->GuardarRTA($parametros);
            print_r($resultadoObject);

            
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
        
?>