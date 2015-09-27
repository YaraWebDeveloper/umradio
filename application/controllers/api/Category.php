<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions

/**
 *
 * @package         xr
 * @subpackage      Server
 * @category        Controller
 * @author          Yara Web Developer
 * @license         MIT
 * @link            https://github.com/yYaraWebDeveloper
 */
class Category extends Server_Controller {

    /**
     * Metodos y accesos dependiendo el nivel de la api
     * @var array
     */
    protected $methods = [
        'users_get' => ['level' => 1]
    ];

    /**
     * Contructor de la clase
     * Referencia a constructor padre
     * 
     * @access public
     */
    function __construct() {
        //Constructor padre
        parent::__construct();
    }

    /**
     *  Funcion para obtener las categorias o una categoria en especifico con id
     */
    public function categories_get() {
        //Obtener las categorias
        $categoria = $this->get("id");
        //Data Where
        $dataWhere = NULL;
        //comprobar las categorias
        if ($categoria):
            $dataWhere = array("cat_id" => $categoria);
        endif;
        //Obtener Categorias
        $dataCategoria = $this->crud_model->obtenerRegistros("categoria", $dataWhere, NULL);
        //si es diferente de vacio
        if ($dataCategoria != NULL):
            //responder peticion
            $this->response($dataCategoria);
        else:
            $this->response(NULL, 204);
        endif;
    }

    /**
     * Funcion para agregar una nueva categoria
     */
    public function addcategory_post() {
        //recibir boton los post
        if ($this->post('save')):
            //Array de datos
            $dataAgregar = array(
                "cat_nombre" => $this->post("cat_nombre"),
                "cat_fecha_creacion" => fecha_exacta(),
                "est_id" => $this->post("est_id")
            );
            //Agregar los datos
            if ($this->crud_model->agregarRegistro("categoria", $dataAgregar) > 0):
                $this->response(TRUE, 201);
            endif;
        else:
            $this->response(array("error" => "no parameters"), 400);
        endif;
    }

    /**
     * Funcion para editar una nueva categoria
     */
    public function updatecategory_post() {
        //recibir boton los post
        if ($this->post('update')):
            //Array de datos
            $dataAgregar = array(
                "cat_nombre" => $this->post("cat_nombre"),
                "cat_fecha_edicion" => fecha_exacta(),
                "est_id" => $this->post("est_id")
            );
            //Where de actualizacion
            $dataWhere = array(
                "cat_id" => $this->post("cat_id")
            );
            //Agregar los datos
            if ($this->crud_model->actualizarRegistro("categoria", $dataAgregar, $dataWhere) > 0):
                $this->response(TRUE, 200);
            endif;
        else:
            $this->response(array("error" => "no parameters"), 400);
        endif;
    }

}
