<?php

use contratos\modificarContrato\funcion\redireccion;

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

        $cadenaSql = $this->miSql->getCadenaSql('eliminarElementoActa', $_REQUEST ['id_elemento_acta']);
        $eliminado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "acceso", $_REQUEST ['id_elemento_acta'], "eliminarElementoActa");


        $datosModificacion = array(
            "id_elemento_acta" => $_REQUEST ['id_elemento_acta'],
            'numerocontrato' => $_REQUEST['numerocontrato'],
            'vigencia' => $_REQUEST['vigencia'],
            'arreglo' => stripslashes($_REQUEST['arreglo']),
            'mensaje_titulo' => $_REQUEST['mensaje_titulo'],
        );


        if ($eliminado) {
            $this->miConfigurador->setVariableConfiguracion("cache", true);
            redireccion::redireccionar('eliminoElemento',$datosModificacion);
            exit();
        } else {

            redireccion::redireccionar('noeliminoElemento');
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