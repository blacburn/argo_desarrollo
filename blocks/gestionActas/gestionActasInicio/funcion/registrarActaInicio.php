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
                'numero_contrato' => $_REQUEST['numero_contrato'],
                'vigencia' => $_REQUEST['vigencia'],
                'fecha_inicio_acta' => $_REQUEST['fecha_inicio_acta'],
                'observaciones' => $_REQUEST['observaciones'],
                'usuario' => $_REQUEST['usuario'],
                'numero_contrato_suscrito' => $_REQUEST['numero_contrato_suscrito'],
                'accesoCondor' => $_REQUEST['accesoCondor'],
            );
           
        } else {
            $datosActadeInicio = array(
                'numero_contrato' => $_REQUEST['numero_contrato'],
                'vigencia' => $_REQUEST['vigencia'],
                'fecha_inicio_acta' => $_REQUEST['fecha_inicio_acta'],
                'observaciones' => $_REQUEST['observaciones'],
                'usuario' => $_REQUEST['usuario'],
                'numero_contrato_suscrito' => $_REQUEST['numero_contrato_suscrito'],
            );
        }




        $cadenaSql['sql'] = $this->miSql->getCadenaSql('registroActaInicio', $datosActadeInicio);

        $cadenaSql['descripcion'] = 'registroactainicio';
        $cadenaSql['valores'] = $datosActadeInicio;
        array_push($SQLs, $cadenaSql);


        $datosEstado = array(
            'numero_contrato' => $_REQUEST['numero_contrato'],
            'vigencia' => $_REQUEST['vigencia'],
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $_REQUEST['usuario'],
            'estado' => 4
        );

        $SQLsEstadoContratoGeneral['sql'] = $this->miSql->getCadenaSql('insertarEstadoActaContratoGeneral', $datosEstado);
        $SQLsEstadoContratoGeneral['descripcion'] = 'cambiarEstadoActaInicio';
        $SQLsEstadoContratoGeneral['valores'] = $datosEstado;
        array_push($SQLs, $SQLsEstadoContratoGeneral);

        $trans_Registro_Acta = $esteRecursoDB->transaccion($SQLs);

        if ($trans_Registro_Acta != false) {
            $this->miConfigurador->setVariableConfiguracion("cache", true);
            redireccion::redireccionar('registroActa', $datosActadeInicio);
            exit();
        } else {

            redireccion::redireccionar('noRegistroActa', $datosActadeInicio);
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