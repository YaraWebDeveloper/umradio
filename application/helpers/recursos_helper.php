<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Funcion para remplazar estado
 */
if (!function_exists('reemplazarEstado')) {

    /**
     * Remplazar el estado por id
     * 
     * @param   int        $pIdEstado
     * @return  string
     */
    function reemplazarEstado($pIdEstado) {

        //creo el valor retorno
        $valorRetorno = 'Activo';
        if ($pIdEstado == 2) {
            $valorRetorno = 'Inactivo';
        }//fin del if
        //devolvemos el valor retorno
        return $valorRetorno;
    }

}//fin de la función



if (!function_exists('controlSelect')) {

    function controlSelect($pDataRegistros = NULL, $pCampoValue = NULL, $pCampoNombre = NULL) {

        //validamos el parámetro
        if ($pDataRegistros != NULL) {
            //iteramos el arreglo que llega
            $dataRegistros[''] = 'Seleccione una opción';
            foreach ($pDataRegistros as $filaRegistros):
                $dataRegistros[$filaRegistros->$pCampoValue] = $filaRegistros->$pCampoNombre;
            endforeach;
        }//fin del if
        else {
            $dataRegistros = array(
                '' => 'Seleccione una opción',
                '1' => 'Activo',
                '2' => 'Inactivo',
            );
        }//fin del if else
        //devolvemos los datos
        return $dataRegistros;
    }

}//fin de la función
if (!function_exists('controlSelectEys')) {

    function controlSelectEys($pDataRegistros = NULL, $pCampoValue = NULL, $pCampoNombre = NULL) {

        //validamos el parámetro
        if ($pDataRegistros != NULL) {
            //iteramos el arreglo que llega
            $dataRegistros[''] = 'Seleccione una opción';
            foreach ($pDataRegistros as $filaRegistros):
                if ($filaRegistros->pro_tipo == 1):
                    $pCampoNombre = "pro_nombre_eys";
                else:
                    $pCampoNombre = "pro_nombre";
                endif;
                $dataRegistros[$filaRegistros->$pCampoValue] = $filaRegistros->$pCampoNombre;
            endforeach;
        }//fin del if
        else {
            $dataRegistros = array(
                '' => 'Seleccione una opción',
                '1' => 'Activo',
                '2' => 'Inactivo',
            );
        }//fin del if else
        //devolvemos los datos
        return $dataRegistros;
    }

}//fin de la función


if (!function_exists('controlInput')) {

    function controlInput($pNombre, $pValor, $pPlaceHolder, $pClase = "", $pDisabled = FALSE, $pMaxLength = 45) {
        $valorInput = array(
            'name' => $pNombre,
            'id' => $pNombre,
            'class' => "input-xlarge " . $pClase,
            'value' => $pValor,
            'maxlength' => $pMaxLength,
            'placeholder' => $pPlaceHolder,
            'placeholder' => $pPlaceHolder,
            'autocomplete' => 'off'
        );
        if ($pDisabled):
            $valorAdicional = array(
                //'disabled' => 'disabled'
                'readonly' => 'readonly',
            );
            $valorInput = array_merge((array) $valorInput, (array) $valorAdicional);
        endif;
        return $valorInput;
    }

}

//FUNCION PARA LIMPIAR LOS CARACTERES ESPECIAL
if (!function_exists('quitarBakcSlash')) {

    function quitarBakcSlash($string) {
        $string = htmlentities($string);
        $string = stripslashes($string);
        return $string;
    }

}//FIN DE LA FUNCION
//funcion para calcular dias transucrridos entre dos fechas
if (!function_exists('dias_transcurridos')) {

    function dias_transcurridos($fecha_i, $fecha_f) {
        $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }

}

/**
 *  Hora y fecha exacya
 */
if (!function_exists('fecha_exacta')) {

    /**
     * Funcion par fecha y hora exacta
     * 
     * @param   string      $pFormato       Formato de salida
     * @return  string                      Fecha con formato establecido
     */
    function fecha_exacta($pFormato = 'Y-m-d h:i:s') {
        //Hora exacta
        $dataExacta = date($pFormato);
        //devolver hora
        return $dataExacta;
    }

}