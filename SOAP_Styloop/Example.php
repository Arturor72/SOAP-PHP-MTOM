<?php
/**
 * Created by PhpStorm.
 * User: arturo
 * Date: 6/9/16
 * Time: 9:46 PM
 */

require_once 'SunatSoapClient.php';

$wsdl="http://localhost:9998/ws/img?wsdl";
$namespace="http://ws.styloops.com/";
$operation="uploadImage";
$soapAction="uploadImage";
$cid="arturo.php";

$parameters=array('arg0' => '<inc:Include href="cid:'.$cid.'" xmlns:inc="http://www.w3.org/2004/08/xop/include"/>');

$pathFile="/home/arturo/earth.png";
$contentType="img/x-png";

$sunatClient=new  SunatSoapClient();
$sunatClient->createClient($wsdl);
$sunatClient->setParameters();
$sunatClient->addAttachment('',$pathFile, $contentType, $cid);
$sunatClient->setCredentials('arturo','arturo123');
$result = $sunatClient->callOperation($operation,$namespace, $parameters, $soapAction);

echo $result;
