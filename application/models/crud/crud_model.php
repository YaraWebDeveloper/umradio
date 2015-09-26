<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * Modelo para hacer consultas SQL.
 *
 *  obtenerRegistros
 *  obtenerRegistrosFull  
 *  agregarRegistro
 *  actualizarRegistro
 *  agregarRegistrosFull
 *  scalarRegistro
 *
 * @package         xr
 * @subpackage      Core
 * @category        Model
 * @author          jucactru, Yara Web Developer 
 * @license         GPL
 * @version         1.0
 */
class Crud_model extends CI_Model {

    /**
     * Contructor de la clase
     * Hace llamada de contructor padre
     * 
     * @access public
     */
    public function __construct() {
        //constructor padre
        parent::__construct();
    }

    /**
     * Funcion simpre para obtener registros de una tabla
     * 
     * Seleccion posibles:
     * 
     * Tabla    -Obligatorio
     * Where    -Opcional
     * Select   -Opcional
     * Limit    -Opcional
     * Order    -Opcional
     * 
     * @access  public
     * 
     * @param   String                  $pTabla         Tabla de la consulta
     * @param   String|Array            $pArrayWhere    Condicioneales de la consulta
     * @param   String                  $pSelect        Campos a seleccionar en la tabla
     * @param   String                  $pOrder         Ordenar registros
     * @param   String                  $pLimit         Limite de registros
     * 
     * @return  Array                   Array de los datos encontrados
     */
    public function obtenerRegistros($pTabla, $pArrayWhere = NULL, $pSelect = NULL, $pOrder = NULL, $pLimit = NULL) {
        //si no se especifica la base de datos se carga la default
        $dataDB = $this->load->database('default', TRUE);
        //verifico el parámetro para preparar la consulta SELECT
        if ($pSelect != NULL):
            $dataDB->select($pSelect);
        endif;
        //verifico el parámetro para preparar la consulta WHERE
        if ($pArrayWhere != NULL) :
            $sqlRegistros = $dataDB->where($pArrayWhere);
        endif;
        //verifico el parámetro para preparar la consulta WHERE
        if ($pOrder != NULL) :
            $sqlRegistros = $dataDB->order_by($pOrder);
        endif;
        //verifico el parámetro para preparar la consulta WHERE
        if ($pLimit != NULL) :
            $sqlRegistros = $dataDB->limit($pLimit);
        endif;
        //realizo la consulta 
        $sqlRegistros = $dataDB->get($pTabla);
        //validamos si existen registros
        if ($sqlRegistros->num_rows() > 0) :
            //iniciamos la iteracion de los datos
            foreach ($sqlRegistros->result() as $filaTabla):
                $dataRegistro[] = $filaTabla;
            endforeach;
        else :
            //se envia un arreglo vacio
            $dataRegistro = null;
        endif;
        //devolvemos la data
        return $dataRegistro;
    }

    /**
     * Funcion completa para obtener registros de una tabla
     * 
     * Seleccion posibles:
     * 
     * Tabla    -Obligatorio
     * Where    -Opcional
     * Select   -Opcional
     * Limit    -Opcional
     * Order    -Opcional
     * Join     -Opcional
     * Group    -Opcional
     * WhereOr  -Opcional
     * 
     * @param Array     $pDataQuery     Array de contruccion para la consulta
     * 
     * @return  Array                   Array de los datos encontrados
     */
    public function obtenerRegistrosFull($pDataQuery) {
        //si no se especifica la base de datos se carga la default
        $dataDB = $this->load->database('default', TRUE);
//verifico el parámetro para preparar la consulta SELECT
        if (isset($pDataQuery["dataColumns"])) :
            $dataDB->select($pDataQuery["dataColumns"]);
        endif;
        //verifico el parámetro para preparar la consulta WHERE
        if (isset($pDataQuery["dataWhere"])) :
            $dataDB->where($pDataQuery["dataWhere"]);
        endif;
        //si hay valor de arrayWhereOr realizo preparo la condicionale orWhere
        if (isset($pDataQuery['dataWhereOr'])):
            $dataDB->or_where($pDataQuery['dataWhereOr']);
        endif;
        //si hay valor de order by, se incluyen todos en una cadena separados por comas
        //ejemplo "usuario desc, id asc"
        if (isset($pDataQuery['dataOrder'])):
            $dataDB->order_by($pDataQuery['dataOrder']);
        endif;
        //si hay valor de group by se agrega a la consulta
        if (isset($pDataQuery['dataGroupBy'])):
            $dataDB->group_by($pDataQuery['dataGroupBy']);
        endif;
        //si hay un valor en dataJoin se incluye en la consulta
        if (isset($pDataQuery['dataJoin'])):
            if (is_array($pDataQuery['dataJoin'])):
                foreach ($pDataQuery['dataJoin'] as $join):
                    $dataDB->join($join['table'], $join['compare'], $join['method']);
                endforeach;
            else:
                $dataDB->join($pDataQuery['dataJoin']['table'], $pDataQuery['dataJoin']['compare'], $pDataQuery['dataJoin']['method']);
            endif;
        endif;
        //si hay un valor en dataJoin se incluye en la consulta
        if (isset($pDataQuery['dataLimit'])):
            $dataDB->limit($pDataQuery['dataLimit']);
        //$this->db->limit(10);
        endif;
        //realizo la consulta 
        $sqlRegistros = $dataDB->get($pDataQuery['dataTable']);
        //validamos si existen registros
        if ($sqlRegistros->num_rows() > 0) :
            //iniciamos la iteracion de los datos
            foreach ($sqlRegistros->result() as $filaTabla):
                $dataRegistro[] = $filaTabla;
            endforeach;
        else :
            //si no se encuentra ningún resultado en la consulta
            //se envia un arreglo vacio
            $dataRegistro = null;
        endif;
        //devolvemos la data
        //$this->$dataDB->close();
        return $dataRegistro;
    }

//fin del metodo    


    /*
     * -------------------------------------------------------
     *  Método para obtener solo un registro y dada la necesidad
     *  retornarlo
     * ------------------------------------------------------- 
     */

    public function scalarRegistro($pDataQuery, $pReturn = NULL) {
        //si no se especifica la base de datos se carga la default
        $dataDB = $this->load->database('default', TRUE);
        //creo la variable de retorno y le aignamos true
        $valorRetorno = TRUE;
        //si hay valor de arrayWhere realizo preparo la condicionale where
        if ($pDataQuery['dataWhere'] != NULL):
            $dataDB->where($pDataQuery['dataWhere']);
        endif;
        //si hay valor de arrayWhereOr realizo preparo la condicionale orWhere
        if ($pDataQuery['dataWhereOr'] != NULL):
            $dataDB->or_where($pDataQuery['dataWhereOr']);
        endif;
        //definimos la variable para el select campos a seleccionar
        $columns = "*";
        //si llega un valor para seleccionar cambiamos el valor de $columns
        if ($pDataQuery['dataColumns'] != NULL):
            $columns = $pDataQuery['dataColumns'];
            //asignamos el valor al select
            $dataDB->select($columns);
        endif;
        //preparo la sentencia sql y obtengo los datos
        $sqlConsulta = $dataDB->get($pDataQuery['dataTable'], 1, 0);

        //validamos si existen registros
        if ($sqlConsulta->num_rows() > 0):
            //validamos si se solicita el objeto
            if ($pReturn):
                //iteramos el objeto
                foreach ($sqlConsulta->result() as $filaTabla):
                    $valorRetorno[] = $filaTabla;
                endforeach;
            else:
                //cambiamos el estado a false
                $valorRetorno = FALSE;
            endif;
        //fin del if else
        endif;
        //fin del if
        //devolvemos el valor retorno
        return $valorRetorno;
    }

//fin del metodo



    /*
     * -------------------------------------------------------
     *  Método para agregar registros en el módulo accesorio 
     * ------------------------------------------------------- 
     */

    public function agregarRegistro($pTabla, $pArrayInsert) {
        //si no se especifica la base de datos se carga la default
        $dataDB = $this->load->database('default', TRUE);
        //ejecuto la inserción
        return $insertar = $dataDB->insert($pTabla, $pArrayInsert);
    }

//fin del médoto

    /*
     * -------------------------------------------------------
     *  Método para actualizar registros
     * ------------------------------------------------------- 
     */

    public function actualizarRegistro($pTabla, $pArrayActualizar, $pArrayWhere) {
        //si no se especifica la base de datos se carga la default
        $dataDB = $this->load->database('default', TRUE);
        //hago la actualización
        $dataDB = $this->db->where($pArrayWhere);
        return $dataDB = $this->db->update($pTabla, $pArrayActualizar);
    }

    /*
     * -------------------------------------------------------
     *  Método para agregar registros multiples 
     * ------------------------------------------------------- 
     */

    public function agregarRegistroMultiple($pTabla, $pArrayInsert) {
        //creo la variable de retorno
        $valorRetorno = null;
        //verificar que base de datos necesita
        //si no se especifica la base de datos se carga la default
        $dataDB = $this->load->database('default', TRUE);
        //ejecuto la inserción
        $valorRetorno = $dataDB->insert_batch($pTabla, $pArrayInsert);

        //devolvemos la variable de retorno
        return $valorRetorno;
    }

//fin del médoto
//fin del médoto    
}

//fin de la clase
