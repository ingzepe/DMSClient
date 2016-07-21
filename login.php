<?php

require 'coneccion.php';


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$token = isset($request->token) ?  $request->token : null;
$url = $request->url;
$user = $request->user;
$pass = $request->pass;
$estados = $request->estado;
$causa = isset($request->causa) ? $request->causa->codigo : '';
$newCintillo = isset($request->newCintillo) ? $request->newCintillo : '';
$registros = split(',', $request->registros);
$registro = isset($request->registro) ? $request->registro : null;
$resultadoArray;


if (empty($token)) {
        $ws = new coneccion($url);
        $resultado = $ws->login($user, $pass);
        $resultadoArray = array('code' => $resultado->code, 'message' => $resultado->message[''], 'token' => $resultado->token);
}else {
    $ws = new coneccion($url);
    if (in_array((string) $estados, array(8, 9, 12, 13, '15c', 18, '19c', '20c', 24, 23, 27, 26, 29, 45))) { //cintillos
//        foreach ($registros as $registro) {
        $date = new DateTime();
        $cintillo = new stdClass();
        $cintillo->cintillo_number = trim($registro);
        $cintillo->datetime = $date->format('Y-m-d H:i:s');
        $cintillo->namePlace = 'CMP Desarrollo';
        $values[0] = $cintillo;

        $resultadoCS = $ws->changeStatus($token, $user, $estados, new SoapVar($values, SOAP_ENC_ARRAY));
        $resultadoArray = array('code' => $resultadoCS->code, 'message' => array_values($resultadoCS->message));
//        }
    } elseif (in_array((string) $estados, array(34, 15, 20, 25, 30, 42, 43))) { //sobres
//        foreach ($registros as $registro) {
        $date = new DateTime();
        $sobre = new stdClass();
        $sobre->barcode = trim($registro);
        $sobre->datetime = $date->format('Y-m-d H:i:s');
        $sobre->casuistry_code = $causa;
        $values[0] = $sobre;

        $resultadoCS = $ws->changeStatus($token, $user, $estados, new SoapVar($values, SOAP_ENC_ARRAY));
        $resultadoArray = array('code' => $resultadoCS->code, 'message' => array_values($resultadoCS->message));
//        }
    } elseif (in_array((string) $estados, array(16, 17))) { //Resultado de visita
//        foreach ($registros as $registro) {
        $date = new DateTime();
        $visita = new stdClass();
        $visita->receiver_name = 'Desarrollo CMP';
        $visita->identification_type_code = '1';
        $visita->identification_number = 'CMP123456';
        $visita->kinship_code = '1';
        $visita->casuistry_code = $causa;

        $sobre = new stdClass();
        $sobre->barcode = trim($registro);
        $sobre->datetime = $date->format('Y-m-d H:i:s');
        $sobre->namePersonCourier = 'CMP Desarrollo';
        $values[0] = $visita;
        $values[1] = $sobre;

        $resultadoCS = $ws->changeStatus($token, $user, $estados, new SoapVar($values, SOAP_ENC_ARRAY));
        $resultadoArray = array('code' => $resultadoCS->code, 'message' => array_values($resultadoCS->message));
//        }
    } elseif (in_array((string) $estados, array(22, '23a', 19, 44, 28))) { //Armado de cintillo
//        foreach ($registros as $registro) {
        $date = new DateTime();
        $sobre = new stdClass();
        $sobre->barcode = trim($registro);
        $sobre->tracking_code = trim($registro);

        $cintillo = new stdClass();
        $cintillo->cintillo_number = trim($newCintillo);
        $cintillo->datetime = $date->format('Y-m-d H:i:s');
        $cintillo->nameCourier = 'CMP Desarrollo';
        $cintillo->namePlace = 'CMP Desarrollo';
        $values[0] = $sobre;
        $values[1] = $cintillo;

        $resultadoCS = $ws->changeStatus($token, $user, $estados, new SoapVar($values, SOAP_ENC_ARRAY));
        $resultadoArray = array('code' => $resultadoCS->code, 'message' => array_values($resultadoCS->message));
    }
//    }
}

$respuesta = json_encode($resultadoArray);
echo $respuesta;

