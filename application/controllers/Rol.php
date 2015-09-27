<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * El siguiente controlador permitirá el manejo de las acciones para adminitrar
 * los roles de usuario que se manejarán en el sistema. 
 *
 * @author YARA WEB Developer
 */
class Rol extends General_Controller {

    //constructor de la clase
    public function __construct() {
        parent::__construct();
        $this->construccionSitio();
    }

    //fin del constructor de la clase

    /*
     * -----------------------------------------------------------------------
     * controlador index
     * -----------------------------------------------------------------------
     */

    public function index($pMensaje = NULL) {
        //determino cual es el acción
        $dataAction = $this->uri->segment(1) . "/crearUsuarioRol";
        //obtengo los registros
        $dataWhere = array(
            'usu_rol_id !=' => '1'
        );
        $dataRegistros = $this->crud_model->obtenerRegistros("usuario_rol", $dataWhere);
        if ($dataRegistros == NULL) :
            $dataRegistros = ' ';
        endif;
        //fin del if
        //preparo el array que se enviará
        $valorNombre = NULL;
        $valorEstado = NULL;
        $valorId = NULL;
        $dataDatos = array(
            'Action' => $dataAction,
            'Registros' => $dataRegistros,
            'valorNombre' => $valorNombre,
            'valorEstado' => $valorEstado,
            'valorId' => $valorId,
            'valorMensaje' => $pMensaje['mensaje'],
            'valorTipoMensaje' => $pMensaje['tipo']
        );
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //abro la vista
        $this->load->view("usuarios/rol_view", $this->dataSend);
    }

//fin del metodo


    /*
     * -----------------------------------------------------------------------
     * Controlador para cargar en los controladores los datos para editar un rol
     * -----------------------------------------------------------------------
     * Párametros
     * @pId |   Int   | Valor defecto: NULL | Párametro identificador para filtrar rol en la DB
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */

    public function editarUsuarioRol($pId = NULL) {
        //Comprobar que el id desde que se accede cexiste
        if ($this->validarIdRol($pId)):
            //verifico que no esten intentando modificar el Superadministrador
            if ($pId > 1):
                $this->controlarAcceso("get");
                //determino cual es el acción
                $dataAction = $this->uri->segment(1) . "/actualizarUsuarioRol";
                //creo el arreglo where
                $dataWhere = array(
                    "usu_rol_id" => $pId
                );
                //consulto el registro
                $dataAccesorio = $this->crud_model->obtenerRegistros("usuario_rol", $dataWhere);
                //itero los resultados
                foreach ($dataAccesorio as $itemAccesorio):
                    $valorNombre = $itemAccesorio->usu_rol_nombre;
                    $valorEstado = $itemAccesorio->est_id;
                    $valorId = $itemAccesorio->usu_rol_id;
                endforeach;
                //preparo el array que enviará
                $dataDatos = array(
                    'Action' => $dataAction,
                    'Registros' => NULL,
                    'valorNombre' => $valorNombre,
                    'valorEstado' => $valorEstado,
                    'valorId' => $valorId,
                    'valorRedirect' => NULL,
                    'valorMensaje' => NULL,
                    'valorTipoMensaje' => NULL
                );
                $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
                //abro la vista
                $this->load->view("usuarios/rol_view", $this->dataSend);
            else: //si intenta entrar como superadministrador
                //lo llevo al inicio de la aplicacion
                //preparo el array de mensaje y tipo de mensaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Algo ha ido mal!
                    </strong>
                    No puedes ingresar a este Rol.
                 </p>',
                    'tipo' => 'alert-error'
                );
                //envio el array de mensaje a index
                $this->index($dataMensaje);
            endif; //fin de verificación superusuario
        else:
            //lo llevo al inicio de la aplicacion
            //preparo el array de mensaje y tipo de mensaje
            $dataMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Algo ha ido mal!
                    </strong>
                    No puedes ingresar a este Id.
                 </p>',
                'tipo' => 'alert-error'
            );
            //envio el array de mensaje a index
            $this->index($dataMensaje);
        endif;
    }

//fin del controlador

    /*
     * -----------------------------------------------------------------------
     * Controlador para crear un usuario rol
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin varables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */

    public function crearUsuarioRol() {

        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar', 1)) :
            //creo el data insert
            $dataInsert = array(
                'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE)
            );
            if ($this->crud_model->agregarRegistro('usuario_rol', $dataInsert) > 0) :
                //preparo el where que le enviare
                $dataWhere = array(
                    'usu_rol_nombre' => $this->input->post('usu_rol_nombre')
                );
                //consulto el registro
                $idAgregado = $this->crud_model->obtenerRegistros('usuario_rol', $dataWhere);
                //itero los resultados
                foreach ($idAgregado as $itemAgregado):
                    $dataId = $itemAgregado->usu_rol_id;
                endforeach;
                //ejecutamos la redireccion
                //Forma general
                // $this->redireccionar();
                //Forma Desarrollada N1
                //redirect('/permisorol/editarPermisoRol/' . $dataId);
                //Forma Desarrollada N2
                //preparo el mensaje y el tipo de mesaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Bien Hecho!
                    </strong>
                    Has creado el rol: "' . $this->input->post('usu_rol_nombre') . '" satisfacotriamente
                        <br />Bien, ahora debes crear permisos de para este rol. 
                    <strong>
                        <a href="' . base_url("/permisorol/editarPermisoRol/" . $dataId) . '"> Click aqui para hacerlo</a>
                    </strong>
                 </p>',
                    'tipo' => 'alert-success'
                );
                //envio el array de mensaje a index
                $this->index($dataMensaje); /**/
            endif;
        //fin del if
        else :
            $this->index();
        endif;
    }

    //fin del controlador

    /*
     * -----------------------------------------------------------------------
     * Controlador para actualizar un rol
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */

    public function actualizarUsuarioRol() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')) :
            //creo el data actualizar
            $dataActualizar = array(
                'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE)
            );
            //creo el arreglo where
            $dataWhere = array(
                'usu_rol_id' => $this->input->post('usu_rol_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("usuario_rol", $dataActualizar, $dataWhere) > 0) :
                //preparo el array de mensaje y tipo de mensaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Perfecto!
                    </strong>
                    Has actualizado los datos de el rol: "' . $this->input->post('usu_rol_nombre') . '" satisfactoriamente.
                 </p>',
                    'tipo' => 'alert-success'
                );
                //envio el array de mensaje a index
                $this->index($dataMensaje);
            endif;
        //fin del if
        else:
            $this->index();
        endif;
    }

    //fin del controlador    

    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por nombre usuario rol
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si se encuentra en la DB valores
     *  similares de rol
     */
    public function validarUsuarioRol() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario_rol',
            'dataColumns' => 'usu_rol_id',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => NULL
        );
        if ($this->crud_model->scalarRegistro($dataSendQuery)) :
            //cambio el valor Retorno
            $valorRetorno = TRUE;
        endif;
        //devolvemos el valor retorno
        return $valorRetorno;
    }

    //fin del controlador  

    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por Id
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si se encuentra en la DB valores similares en Id.
     */

    public function validarUsuarioRolId() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE),
            'usu_rol_id !=' => $this->input->post('usu_rol_id', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario_rol',
            'dataColumns' => 'usu_rol_id',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => NULL
        );
        if ($this->crud_model->scalarRegistro($dataSendQuery)) :
            //cambio el valor Retorno
            $valorRetorno = TRUE;
        endif;
        //devolvemos el valor retorno
        return $valorRetorno;
    }

    //fin del controlador  

    /*
     * -----------------------------------------------------------------------
     *  controlador validar los controles de la vista
     * ----------------------------------------------------------------------- 
     * Párametros
     * @pControl | String | Sin valor por defecto | Este es necesario para saber que tipo de accion se realizara e
     *                                              ejemplo:  'guardar'
     * 
     * @pTipo | int | Valor por defecto: 0 | Validacion desde otro metodo | valores posibles: 0, 1
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | boolean | true   | Si todos los controles de la vista son aceptados
     */

    private function validarControles($pControl, $pTipo = 0) {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //validamos los datos
        if ($this->input->post($pControl)):
            //creo la variable de validación del campo nombre
            $valorValidacion = 'required';
            if ($pTipo == 1):
                $valorValidacion .= '|callback_validarUsuarioRol';
            else:
                $valorValidacion .= '|callback_validarUsuarioRolId';
            endif; //fin del if
            $this->form_validation->set_rules('usu_rol_nombre', 'Usuario Rol', $valorValidacion);
            $this->form_validation->set_rules('est_id', 'Estado', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('validarUsuarioRolId', 'Otro regístro ya existe con el nombre que ingresó en el campo <strong>%s</strong>');
            $this->form_validation->set_message('validarUsuarioRol', 'El nombre que ingresó en el campo <strong>%s</strong> ya existe');

            //verificamos las validaciones
            if ($this->form_validation->run() == TRUE) :
                //cambio el valor retono
                $valorRetorno = TRUE;
            endif;
        //fin del if
        endif;
        //devuelvo el valor retorno
        return $valorRetorno;
    }

    //fin del controlador


    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por Id
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si no en la DB valores similares en Id.
     */

    public function validarIdRol($pId) {
        //creo la variable de retorno
        $valorRetorno = TRUE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_rol_id' => $pId
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario_rol',
            'dataColumns' => 'usu_rol_id',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => NULL
        );
        if ($this->crud_model->scalarRegistro($dataSendQuery)) :
            //cambio el valor Retorno
            $valorRetorno = FALSE;
        endif;
        //devolvemos el valor retorno
        return $valorRetorno;
    }

}
