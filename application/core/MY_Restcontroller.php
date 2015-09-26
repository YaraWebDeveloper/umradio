<?php

require APPPATH . '/libraries/REST_Controller.php';

class MY_Restcontroller extends REST_Controller {

    /**
     * Contructor de la clase
     * Permite solicitudes CORS (desde otras url, servidores o dominios)
     * 
     * @access public
     */
    public function __construct() {
        //Declarar los header para permitir solicirudes desde cualquier servidor
        header('Access-Control-Allow-Origin: *');
        //Nombre de API Key, debe ser configurada en config/rest.php -> REST API Key Variable
        header("Access-Control-Allow-Headers: accept-auth");
        //Permitir acceso por solicitud option
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS")
            die();
        //Hacer llamado de contructor padre
        parent::__construct();
    }

}
