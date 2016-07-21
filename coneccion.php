<?php

/*	

Abcd1234
	

ezepedac
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of coneccion
 *
 * @author zepeda
 */
class coneccion {
    
    protected $cliente;
    public $code;
    public $message;


    public function __construct($url) {
        $this->cliente = new SoapClient($url);
    }
    
    public function login($usuario, $clave){
        $respuesta = $this->cliente->__soapCall('login', array($usuario, $clave));
        return $respuesta;
        
    }
    
    public function changeStatus($token, $username, $status, $values){
        try{
            $resultado = $this->cliente->__soapCall('changeStatus', array($token, $username, $status, $values ));
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            $this->code = $e->getCode();
            return $this;
        }
        return $resultado;
    }

}