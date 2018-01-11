<?php

use gestionActas\gestionActasInicio\funcion\redireccion;

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

        $SQLs = [];

        if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {
            $datosActadeInicio = array(
                'fecha_inicio_acta' => $_REQUEST['fecha_inicio_acta'],
                'observaciones' => $_REQUEST['observaciones'],
                'vigencia' => $_REQUEST['vigencia'],
                'numero_contrato' => $_REQUEST['numero_contrato'],
                'id_acta' => $_REQUEST['id_acta'],
                'usuario' => $_REQUEST['usuario'],
                'numero_contrato_suscrito' => $_REQUEST['numero_contrato_suscrito'],
                'accesoCondor' => $_REQUEST['accesoCondor'],
            );
        
        } else {
            $datosActadeInicio = array(
                'fecha_inicio_acta' => $_REQUEST['fecha_inicio_acta'],
                'observaciones' => $_REQUEST['observaciones'],
                'vigencia' => $_REQUEST['vigencia'],
                'numero_contrato' => $_REQUEST['numero_contrato'],
                'id_acta' => $_REQUEST['id_acta'],
                'usuario' => $_REQUEST['usuario'],
                'numero_contrato_suscrito' => $_REQUEST['numero_contrato_suscrito'],
            );
        }



        $cadenaSql['sql'] = $this->miSql->getCadenaSql('modificarActaInicio', $datosActadeInicio);
        $cadenaSql['descripcion'] = 'modificarActaInicio';
        $cadenaSql['valores'] = $datosActadeInicio;
        array_push($SQLs, $cadenaSql);




        $trans_Registro_Acta = $esteRecursoDB->transaccion($SQLs);

        if ($trans_Registro_Acta != false) {
            $this->miConfigurador->setVariableConfiguracion("cache", true);
            redireccion::redireccionar('modificoActa', $datosActadeInicio);
            exit();
        } else {

            redireccion::redireccionar('noModificoActa', $datosActadeInicio);
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