<?php

/**
 * Created by PhpStorm.
 * User: arturo
 * Date: 6/8/16
 * Time: 10:37 PM
 */


require_once('lib/nusoap.php');
require_once ('lib/nusoapmime.php');
class SunatSoapClient
{
    var $client='';
    var $fault='';

    public function createClient($wsdl){
        $this->client=new nusoap_client_mime($wsdl, false);
    }

    public function setParameters(){
        $this->client->setHTTPEncoding('deflate, gzip');

    }

    public function addAttachment($content='',$path, $contentType, $cid){
        $this->client->addAttachment($content, $path, $contentType,$cid);
    }

    public function callOperation($operation,$namespace,$parameters, $action){
        $result = $this->client->call($operation, $parameters,$namespace,$action);
        if($this->client->fault){
            return $result;
        }else{
            $error=$this->client->getError();
            if($error){
                $result="Error: "+$error;
            }
            return $result;
        }
   }
    public function setCredentials($user, $password){
        $this->client->setCredentials($user, $password);
    }

 }