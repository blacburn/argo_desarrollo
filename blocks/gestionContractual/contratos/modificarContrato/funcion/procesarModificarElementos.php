<?php

use contratos\modificarContrato\funcion\redireccion;

include_once ('redireccionar.php');
if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorOrden {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;

    function __construct($lenguaje, $sql, $funcion) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
    }

    function procesarFormulario() {


        $conexion = "contractual";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        $fechaActual = date('Y-m-d');
        // ------- Registro de Imagen
        // -------------------------------------

        $cadenaSql = $this->miSql->getCadenaSql('consultar_iva', $_REQUEST ['iva']);

        $valor_iva = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $valor_iva = $valor_iva [0] [0];



        $arreglo = array(
            'id' => $_REQUEST ['id_item'],
            'nombre' => $_REQUEST ['nombre'],
            'descripcion' => $_REQUEST ['descripcion'],
            'unidad' => $_REQUEST ['unidad'],
            'cantidad' => $_REQUEST ['cantidad'],
            'valor' => $_REQUEST ['valor'],
            'iva' => $_REQUEST ['iva'],
            'dependencia_solicitante' => (isset($_REQUEST ['dependencia_solicitante']) ) ? $_REQUEST ['dependencia_solicitante'] : null,
            'funcionario' => (isset($_REQUEST ['funcionario'])) ? $_REQUEST ['funcionario'] : null,
            'tiempo_ejecucion' => $_REQUEST ['tiempo_ejecucion'],
        );

        $cadenaSql = $this->miSql->getCadenaSql('actualizar_elemento_o_servicio', $arreglo);
        $elemento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso", $arreglo, 'actualizar_elemento_o_servicio');



     


        $datos = array(
            $_REQUEST ['mensaje_titulo'],
            $_REQUEST ['numerocontrato'],
            $fechaActual,
            (!isset($_REQUEST ['registroOrden'])) ? $_REQUEST ['arreglo'] : $_REQUEST ['registroOrden'],
            $_REQUEST ['usuario'],
            $_REQUEST ['vigencia'],
            "id_elemento_acta" => $_REQUEST ['id_elemento_acta'],
            'numerocontrato' => $_REQUEST['numerocontrato'],
            'vigencia' => $_REQUEST['vigencia'],
            'arreglo' => stripslashes($_REQUEST['arreglo']),
            'mensaje_titulo' => $_REQUEST['mensaje_titulo'],
        );
//                



        if ($elemento) {
            $this->miConfigurador->setVariableConfiguracion("cache", true);

            redireccion::redireccionar("modificoElementos", $datos);
            exit();
        } else {

            redireccion::redireccionar("noModificoElementos", $datos);
            exit();
        }
    }

    function resetForm() {
        foreach ($_REQUEST as $clave => $valor) {

            if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
                unset($_REQUEST [$clave]);
            }
        }
    }

}

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>