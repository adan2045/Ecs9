<?php

require_once 'responses/nuevo.php';
require_once '../../modelo/mediosDeContacto.php';
require_once '../../modelo/vehiculo.php';

header('Content-Type: application/json');

$resp = new NuevoResponse();
$resp->ItsOk=true;
$resp->Mensaje=' ';


$json=file_get_contents('php://input',true);
$req=json_decode($json);

if($req->NroPoliza>1000 || $req->NroPoliza<0 ){
    $resp->ItsOk=false;
    $resp->Mensaje=' la poliza no existe ';
}
else {
    if ($req->Vehiculo==null){
        $resp->ItsOk=false;
        $resp->Mensaje=' debe indicar el vehiculo ';
    }
    else {
        if ($req->Vehiculo->Marcaarca==null
        || $req->Vehiculo->Modelo==null
        || $req->Vehiculo->Version==null
        || $req->Vehiculo->Anio==null){
            $resp->ItsOk=false;
            $resp->Mensaje=' debe indicar todas las propiedades del vehiculo ';
        }
    }
    $contador=0;
    foreach ($req->$ListMediosDeContacto as $MedioContacto){
        $contador=$contador+1;
    }
    
    if ($MedioContacto->MedioContactoDescripcion != "Mail" 
    && $MedioContacto->MedioContactoDescripcion != "Celular"){
        $resp->ItsOk=false;
        $resp->Mensaje=' debe indicar medios de contactos validos ';
        break;
    }
}

   
            
             


echo json_encode($resp);
