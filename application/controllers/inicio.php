<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {

    /**
     * Funcion de inicio
     * 
     * @return void
     */
    public function index() {
        //redirect('http://server.com');
        echo json_encode(["Puto" => "sebastián"]);

        echo 'Funciona';
    }

}
