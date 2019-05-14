<?php

use gestionContractual\registrarElementoContrato\funcion\redireccionar;

$ruta_1 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel.class.php';
$ruta_2 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel/Reader/Excel2007.class.php';

include_once ($ruta_1);
include_once ($ruta_2);

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

        $countFPParam = $_REQUEST ['countItems'];
        $subFP = explode("&", $_REQUEST ['idsItems']);

        $cantidadParametros = ($countFPParam) * 11;

        $limitP = 0;
        while ($limitP < $cantidadParametros) {

            $subCount[$limitP] = explode(" ", $subFP[$limitP]);

            $limitP++;
        }

        $limit = 0;
        $SQLs = [];



        while ($limit < $cantidadParametros) {


            if ($subFP[$limit + 9] !== '') {
                $cadenaSql = $this->miSql->getCadenaSql('buscar_dependencia_por_nombre', $subFP[$limit + 9]);
                $resultadoDependencia = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                $resultadoDependencia =$resultadoDependencia[0][0];
            } else {
                $resultadoDependencia = '';
            }


            if ($subCount[$limit + 1][0] == 1) {

                $arreglo = array(
                    'nombre' => $subFP[$limit + 2],
                    'descripcion' => $subFP[$limit + 3],
                    'unidad' => $subCount[$limit + 6][0],
                    'cantidad' => $subFP[$limit + 5],
                    'valor' => $subFP[$limit + 7],
                    'iva' => $subCount[$limit + 8][0],
                    'dependencia_solicitante' => $resultadoDependencia,
                    'funcionario' => $subCount[$limit + 10][0] ? $subCount[$limit + 10][0] : null,
                    'tiempo_ejecucion' => '',
                    'numero_contrato' => $_REQUEST ['numero_contrato'],
                    'vigencia' => $_REQUEST ['vigencia'],
                    'item' => $subCount[$limit + 1][2]
                );
            }


            if ($subCount[$limit + 1][0] == 2) {


                $arreglo = array(
                    'nombre' => $subFP[$limit + 2],
                    'descripcion' => $subFP[$limit + 3],
                    'unidad' => $subCount[$limit + 6][0],
                    'cantidad' => $subFP[$limit + 5],
                    'valor' => $subFP[$limit + 7],
                    'iva' => $subCount[$limit + 8][0],
                    'dependencia_solicitante' => $resultadoDependencia,
                    'funcionario' => $subCount[$limit + 10][0] ? $subCount[$limit + 10][0] : null,
                    'tiempo_ejecucion' => $subFP[$limit + 4],
                    'numero_contrato' => $_REQUEST ['numero_contrato'],
                    'vigencia' => $_REQUEST ['vigencia'],
                    'item' => $subCount[$limit + 1][2]
                );
//                $datoFP = array(
//                    'objeto_cotizacion' => "currval('agora.prov_objeto_contratar_id_objeto_seq')",
//                    'nombre' => $subFP[$limit + 1],
//                    'descripcion' => $subFP[$limit + 2],
//                    'tipo' => $subCount[$limit + 3][0],
//                    'unidad' => $subCount[$limit + 4][0],
//                    'tiempo' => 0,
//                    'cantidad' => $registroCant
//                );
            }




            $datoRegFP['sql'] = $this->miSql->getCadenaSql('ingresar_elemento_o_servicio', $arreglo);
    
            $datoRegFP['descripcion'] = 'ingresar_elemento_o_servicio';
            $datoRegFP['valores'] = $arreglo;
  


            array_push($SQLs, $datoRegFP);


            $limit = $limit + 11;
        }

        $registroItems = $esteRecursoDB->transaccion($SQLs);
 






        $datos = array(
            $_REQUEST ['mensaje_titulo'],
            $_REQUEST ['numero_contrato'],
            $fechaActual,
            (!isset($_REQUEST ['registroOrden'])) ? $_REQUEST ['arreglo'] : $_REQUEST ['registroOrden'],
            $_REQUEST ['usuario'],
            $_REQUEST ['numero_contrato'],
            $_REQUEST ['vigencia'],
        );


        if ($registroItems) {
            $this->miConfigurador->setVariableConfiguracion("cache", true);

            redireccion::redireccionar("inserto", $datos);
            exit();
        } else {

            redireccion::redireccionar("noInserto", $datos);
            exit();
        }
    }

}

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>