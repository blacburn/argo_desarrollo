<?php

namespace contratos\registrarContrato\funcion;

use contratos\registrarContrato\funcion\redireccion;

// include_once ('redireccionar.php');
if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorContrato {

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

        $conexionFrame = "estructura";
        $frameRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrame);
        $conexion = "contractual";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        $conexionAgora = "agora";
        $esteRecursoDBAgora = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionAgora);

        $SQLs = [];
	$validacionContratoExistente=false;

        //Validacion del tipo de compromiso, para determinar si el contrato 
        //tiene o no convenio asociado
        if ($_REQUEST ['tipo_compromiso'] != '3') {
            $numero_convenio = "";
        } else {
            $numero_convenio = $_REQUEST ['convenio_solicitante'];
        }

        //Validacion campos que pueden ser nulos
        if (isset($_REQUEST ['valor_contrato_moneda_ex']) && $_REQUEST ['valor_contrato_moneda_ex'] != "") {
            $valor_moneda_extranjera = $_REQUEST ['valor_contrato_moneda_ex'];
        } else {
            $valor_moneda_extranjera = "null";
        }
        if (isset($_REQUEST ['tasa_cambio']) && $_REQUEST ['tasa_cambio'] != "") {
            $tasa_cambio = $_REQUEST ['tasa_cambio'];
        } else {
            $tasa_cambio = "null";
        }
	//Validacion para verificar si contratista posee contratos activos
       /* if($_REQUEST ['unidad_ejecutora_hidden']==1 && $_REQUEST ['tipo_contrato']==6){
        if(isset($_REQUEST ['id_proveedor'])){
             $sqlFechaFinContratista = $this->miSql->getCadenaSql('obtenerFechaTerminoContratista', $_REQUEST['id_proveedor']);
             $infoFechaTerminoContratista = $esteRecursoDB->ejecutarAcceso($sqlFechaFinContratista, "busqueda");
             
             if($infoFechaTerminoContratista!=false && $infoFechaTerminoContratista[0][1]==6 && $infoFechaTerminoContratista[0][2]==1){
                 $validacionContratoExistente=true;
             }
        }
        if($validacionContratoExistente==true){
            $datos = array("contratista" => $_REQUEST['id_proveedor'],
                        "fin_contrato_actual" => $infoFechaTerminoContratista[0][0]);
           redireccion::redireccionar("ErrorRegistroContratoExiste", $datos);
            exit;
        }
        }*/
        //validacion campos (observaciones, condiciones y especificaciones tecnicas)
        if (isset($_REQUEST ['especificaciones_tecnicas']) && $_REQUEST ['especificaciones_tecnicas'] != "") {
            $_REQUEST ['especificaciones_tecnicas'] = $_REQUEST ['especificaciones_tecnicas'];
        } else {
            $_REQUEST ['especificaciones_tecnicas'] = "";
        }
        if (isset($_REQUEST ['observacionesContrato']) && $_REQUEST ['observacionesContrato'] != "") {
            $_REQUEST ['observacionesContrato'] = $_REQUEST ['observacionesContrato'];
        } else {
            $_REQUEST ['observacionesContrato'] = "";
        }
        if (isset($_REQUEST ['condiciones']) && $_REQUEST ['condiciones'] != "") {
            $_REQUEST ['condiciones'] = $_REQUEST ['condiciones'];
        } else {
            $_REQUEST ['condiciones'] = "";
        }
        //Obtener la Clausula de Presupuesto
        if (isset($_POST['clausula_presupuesto'])) {
            $clausula_presupuesto = $_POST['clausula_presupuesto'];
        } else {
            $clausula_presupuesto = 'false';
        }
        if (isset($_REQUEST ['clausulas_contractuales']) && $_REQUEST ['clausulas_contractuales'] != "") {
            $clausulas = $_REQUEST ['clausulas_contractuales'];
        } else {
            $clausulas = "";
        }

        //validar tipo de persona para registrar la clase de contratista

        $sqlTipoPersona = $this->miSql->getCadenaSql('obtenerTipoPersona', $_REQUEST['id_proveedor']);
        $infoTipoPersona = $esteRecursoDBAgora->ejecutarAcceso($sqlTipoPersona, "busqueda");
        if ($infoTipoPersona[0]['tipopersona'] == 'CONSORCIO') {
            $_REQUEST ['clase_contratista'] = 32;
        } elseif ($infoTipoPersona[0]['tipopersona'] == 'UNION TEMPORAL') {
            $_REQUEST ['clase_contratista'] = 31;
        } else {
            $_REQUEST ['clase_contratista'] = 33;
        }
        

        //Validar Tipo de supervisor para determinar registro

//        if ($_REQUEST['tipo_supervisor'] == 1) {
         $supervisor = $_REQUEST['nombre_supervisor'];
//        } else {
//            $supervisor = $_REQUEST['nombre_supervisor_interventor'];
//        }

        $infoSupervisor = explode("-", $supervisor);
        //Validar Existencia Supervisor 
        $SqlValidarSupervisor = $this->miSql->getCadenaSql('ObtenerSupervisor', $infoSupervisor[0]);
        $InfoSupervisorRegistrado = $esteRecursoDB->ejecutarAcceso($SqlValidarSupervisor, "busqueda");
        $bandera = false;

        for ($i = 0; $i < count($InfoSupervisorRegistrado); $i++) {
            if ($InfoSupervisorRegistrado[$i]['cargo'] == $_REQUEST ['cargo_supervisor'] &&
                    $InfoSupervisorRegistrado[$i]['sede_supervisor'] == $_REQUEST ['sede_super'] &&
                    $InfoSupervisorRegistrado[$i]['dependencia_supervisor'] == $_REQUEST ['dependencia_supervisor']) {
                $id_supervisor = $InfoSupervisorRegistrado[$i]['id'];
                $bandera = true;
                break;
            }
        }
        if ($bandera == false) {
            //Registro de supervisor
            $datosSupervisor = array(
                'documento' => $infoSupervisor[0],
                'nombre_supervisor' => $infoSupervisor[1],
                'cargo' => $_REQUEST ['cargo_supervisor'],
                'sede' => $_REQUEST ['sede_super'],
                'dependencia' => $_REQUEST ['dependencia_supervisor'],
                'digito_verificacion' => $_REQUEST ['digito_supervisor'],
                'tipo' => $_REQUEST['tipo_supervisor'],
            );

            $infoSupervisor[0] = "currval('argo.supervisor_contrato_id_seq')";
            $SqlSupervisorContrato['sql'] = $this->miSql->getCadenaSql('insertarSupervisor', $datosSupervisor);
            $SqlSupervisorContrato['descripcion'] = 'registroSupervisor';
            $SqlSupervisorContrato['valores'] = $datosSupervisor;
            array_push($SQLs, $SqlSupervisorContrato);
        } else {
            $infoSupervisor[0] = $id_supervisor;
        }


        $infoSupervisor[0] = $_REQUEST ['id_supervisor_hidden'];


        //Registro Ejecucion del contrato
        if (isset($_REQUEST['sede_ejecucion'])) {
            $_REQUEST['sede_ejecucion'] = $_REQUEST['sede_ejecucion'];
        } else {
            $_REQUEST['sede_ejecucion'] = "null";
        }
        if (isset($_REQUEST['dependencia_ejecucion'])) {
            $_REQUEST['dependencia_ejecucion'] = $_REQUEST['dependencia_ejecucion'];
        } else {
            $_REQUEST['dependencia_ejecucion'] = "null";
        }


        $arreglo_info_ejecucion = array(
            'direccion' => $_REQUEST['direccion_ejecucion'],
            'sede' => $_REQUEST['sede_ejecucion'],
            'dependencia' => $_REQUEST['dependencia_ejecucion'],
            'ciudad' => $_REQUEST['ejecucionCiudad'],
        );

        $SqlValidarLugarEjecucion = $this->miSql->getCadenaSql('ObtenerLugardeEjecucion', $arreglo_info_ejecucion);
        $InfoLugarEjecucion = $esteRecursoDB->ejecutarAcceso($SqlValidarLugarEjecucion, "busqueda");
        if ($InfoLugarEjecucion == false) {

            $SqlLugarEjecucion['sql'] = $this->miSql->getCadenaSql('insertarLugarEjecucion', $arreglo_info_ejecucion);
            $SqlLugarEjecucion['descripcion'] = 'registroLugarEjecucion';
            $SqlLugarEjecucion['valores'] = $arreglo_info_ejecucion;
            array_push($SQLs, $SqlLugarEjecucion);
            $lugarEjecucion = "currval('argo.lugar_ejecucion_id_seq')";
        } else {

            $lugarEjecucion = $InfoLugarEjecucion[0][0];
        }

	 $buscar=array(chr(13).chr(10), "\r\n", "\n", "\r");
        $reemplazar=array(" ", " ", " ", " ");
        $_REQUEST['objeto_contrato']=str_ireplace($buscar,$reemplazar,$_REQUEST['objeto_contrato']);
        $_REQUEST ['justificacion']=str_ireplace($buscar,$reemplazar,$_REQUEST ['justificacion']);
        $_REQUEST['actividades']=str_ireplace($buscar,$reemplazar,$_REQUEST['actividades']);
        $_REQUEST ['condiciones']=str_ireplace($buscar,$reemplazar,$_REQUEST ['condiciones']);
        $_REQUEST['especificaciones_tecnicas']=str_ireplace($buscar,$reemplazar,$_REQUEST['especificaciones_tecnicas']);
        $_REQUEST ['observacionesContrato']=str_ireplace($buscar,$reemplazar,$_REQUEST ['observacionesContrato']);
           


        //Registro Datos Generales del  Contrato 
        $arreglo_contrato_general = array('vigencia' => (int) date('Y'),
            'objeto_contrato' => $_REQUEST ['objeto_contrato'],
            'plazo_ejecucion' => $_REQUEST ['plazo_ejecucion'],
            'forma_pago' => $_REQUEST ['formaPago'],
            'ordenador_gasto' => $_REQUEST ['ordenador_gasto'],
            'clausula_presupuesto' => $clausula_presupuesto,
            'sede' => $_REQUEST ['sede'],
            'dependencia' => $_REQUEST ['dependencia_solicitante'],
            'contratista' => $_REQUEST ['id_proveedor'],
            'unidad_ejecucion_tiempo' => $_REQUEST ['unidad_ejecucion_tiempo'],
            'valor_contrato' => $_REQUEST ['valor_contrato'],
            'justificacion' => $_REQUEST ['justificacion'],
            'actividades' => $_REQUEST['actividades'],
            'condiciones' => $_REQUEST ['condiciones'],
            'especificaciones_tecnicas' => $_REQUEST ['especificaciones_tecnicas'],
            'descripcion_forma_pago' => $_REQUEST ['descripcion_forma_pago'],
            'unidad_ejecutora' => $_REQUEST ['unidad_ejecutora_hidden'],
            'tipologia_especifica' => $_REQUEST ['tipologia_especifica'],
            'tipo_compromiso' => $_REQUEST ['tipo_compromiso'],
            'modalidad_seleccion' => $_REQUEST ['modalidad_seleccion'],
            'procedimiento' => $_REQUEST ['procedimiento'],
            'regimen_contratación' => $_REQUEST ['regimen_contratación'],
            'tipo_gasto' => $_REQUEST ['tipo_gasto'],
            'tema_gasto_inversion' => $_REQUEST ['tema_gasto_inversion'],
            'origen_presupuesto' => $_REQUEST ['origen_presupuesto'],
            'origen_recursos' => $_REQUEST ['origen_recursos'],
            'tipo_moneda' => $_REQUEST ['tipo_moneda'],
            'valor_contrato_moneda_ex' => $valor_moneda_extranjera,
            'tasa_cambio' => $tasa_cambio,
            'tipo_control' => $_REQUEST ['tipo_control'],
            'observacionesContrato' => $_REQUEST ['observacionesContrato'],
            'supervisor' => $infoSupervisor[0],
            'clase_contratista' => $_REQUEST ['clase_contratista'],
            'convenio' => $numero_convenio,
            'lugar_ejecucion' => $lugarEjecucion,
            'tipo_contrato' => $_REQUEST ['tipo_contrato'],
            'usuario' => $_REQUEST ['usuario'],
            'fecha_registro' => date('Y-m-d H:m:s')
        );

	
	   $cadenaSql = $this->miSql->getCadenaSql('buscarContratoGeneral', $arreglo_contrato_general);
           $contratoExisteIgual = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        
          if($contratoExisteIgual!=false){
               $datos = array("contrato" => $contratoExisteIgual[0]['numero_contrato'],
                          "vigencia" => $contratoExisteIgual[0]['vigencia'],
                          "contratista" => $contratoExisteIgual[0]['contratista']);
                 
             redireccion::redireccionar("ErrorRegistroContratoDuplicado", $datos);
             exit;
         }

        $SqlcontratoGeneral['sql'] = $this->miSql->getCadenaSql('insertarContratoGeneral', $arreglo_contrato_general);
        $SqlcontratoGeneral['descripcion'] = 'registroContratoGeneral';
        $SqlcontratoGeneral['valores'] = $arreglo_contrato_general;
        array_push($SQLs, $SqlcontratoGeneral);

        //Registro Perfil --------------------------- Contrato CPS ---------------------------------------------
        if ($_REQUEST ['tipo_contrato'] == '6') {

            $arreglo_perfil_cps = array(
                'vigencia' => (int) date('Y'),
                'perfil' => $_REQUEST ['perfil'],
                'numero_contrato' => "currval('argo.numero_unico_contrato_seq')",
            );

            $SqlPerfilCPS['sql'] = $this->miSql->getCadenaSql('insertarPerfilCPS', $arreglo_perfil_cps);
            $SqlPerfilCPS['descripcion'] = 'registroPerfilCPS';
            $SqlPerfilCPS['valores'] = $arreglo_perfil_cps;
            array_push($SQLs, $SqlPerfilCPS);
        }

        //Registrar CDP asociados al contrato


        $disponibilidades = explode(",", substr($_REQUEST['indices_cdps_vigencias'], 1));

        for ($i = 0; $i < count($disponibilidades); $i++) {
            $datos = array(
                'numero_contrato' => "currval('argo.numero_unico_contrato_seq')",
                'vigencia' => (int) date('Y'),
                'numero_disponibilidad' => explode("-", $disponibilidades[$i])[0],
                'vigencia_disponibilidad' => explode("-", $disponibilidades[$i])[1],
            );

            $sqlDisponibilidad['sql'] = $this->miSql->getCadenaSql('insertarContratoDisponibilidad', $datos);
            $sqlDisponibilidad['descripcion'] = 'registroDisponibilidadContrato';
            $sqlDisponibilidad['valores'] = $datos;
            array_push($SQLs, $sqlDisponibilidad);
        }

        // Registro Estado del contrato
        $datosEstado = array(
            'numero_contrato' => "currval('argo.numero_unico_contrato_seq')",
            'vigencia' => (int) date('Y'),
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $_REQUEST['usuario'],
            'estado' => 1
        );

        // Registro Estado Contrato General
        $SQLsEstadoContratoGeneral['sql'] = $this->miSql->getCadenaSql('insertarEstadoContratoGeneral', $datosEstado);
        $SQLsEstadoContratoGeneral['descripcion'] = 'registroEstadoContrato';
        $SQLsEstadoContratoGeneral['valores'] = $datosEstado;
        array_push($SQLs, $SQLsEstadoContratoGeneral);

	// Registrado tipo contrato arrendamiento 
        if ($_REQUEST ['tipo_contrato'] == '5') {
             
            
            if($_REQUEST ['diasHabilesAdmin_hidden']==null || $_REQUEST ['valorAdmin_hidden']==null){
                 $arreglo_arrendamiento = array(
                'destinacion' => $_REQUEST['destinacionArrendamiento_hidden'],
                'plazo_mensual' => $_REQUEST ['diasHabiles_hidden'],
                'reajuste' => $_REQUEST['reajusteArrendamiento_hidden'],
                'plazo_entrega' => $_REQUEST ['diasHabilesEntrega_hidden'],
                'valor_arrendamiento' => $_REQUEST ['valorMensualArrendamiento_hidden'],
                'numero_contrato' => "currval('argo.numero_unico_contrato_seq')",
                'vigencia' => (int) date('Y'),
               );
            }
            else{
                 $arreglo_arrendamiento = array(
                'destinacion' => $_REQUEST['destinacionArrendamiento_hidden'],
                'plazo_mensual' => $_REQUEST ['diasHabiles_hidden'],
                'reajuste' => $_REQUEST['reajusteArrendamiento_hidden'],
                'plazo_admin' => $_REQUEST ['diasHabilesAdmin_hidden'],
                'valor_admin' => $_REQUEST ['valorAdmin_hidden'],
                'plazo_entrega' => $_REQUEST ['diasHabilesEntrega_hidden'],
                'valor_arrendamiento' => $_REQUEST ['valorMensualArrendamiento_hidden'],
                'numero_contrato' => "currval('argo.numero_unico_contrato_seq')",
                'vigencia' => (int) date('Y'),
               );
            }
           

            $SqContratoArrendamiento['sql'] = $this->miSql->getCadenaSql('insertarContratoArrendamiento', $arreglo_arrendamiento);
            $SqContratoArrendamiento['descripcion'] = 'insertarContratoArrendamiento';
            $SqContratoArrendamiento['valores'] = $arreglo_arrendamiento;
            array_push($SQLs, $SqContratoArrendamiento);
            
            
        }


        if($_REQUEST['tablAmparos_hidden']==''){
                $_REQUEST['tablAmparos_hidden']='N/A,0';
                $_REQUEST['tablaSuficiencia_hidden']='N/A,0';
                $_REQUEST['tablaVigencia_hidden']='0,0';
                
            }
            
             
            $arrayAmparos = explode("~", $_REQUEST['tablAmparos_hidden']);
            $arraySuficiencia = explode("~", $_REQUEST['tablaSuficiencia_hidden']);
            $arrayVigencia = explode("~", $_REQUEST['tablaVigencia_hidden']);
           
            
            $count = 0;

            while ($count < $_REQUEST['cantidadAmparos_hidden']) {
                
            
                $arreglo_arrendamientoGeneral = array(
                'numero_contrato' => "currval('argo.numero_unico_contrato_seq')",
                'vigencia_contrato' => (int) date('Y'),
                'amparo' => $arrayAmparos [$count],
                'suficiencia' => $arraySuficiencia [$count],
                'vigencia_amparo' => $arrayVigencia [$count],
                );

                $SqContratoArrendamientoGeneral['sql'] = $this->miSql->getCadenaSql('insertarContratoArrendamientoGeneral', $arreglo_arrendamientoGeneral);
                $SqContratoArrendamientoGeneral['descripcion'] = 'insertarContratoArrendamientoGeneral';
                $SqContratoArrendamientoGeneral['valores'] = $arreglo_arrendamientoGeneral;
                array_push($SQLs, $SqContratoArrendamientoGeneral);
                
               
                 $count++;
                
            }

        $trans_Registro_contrato = $esteRecursoDB->transaccion($SQLs);
        
        $sqlNumeroContrato = $this->miSql->getCadenaSql('obtenerInfoContrato');
        $resultado = $esteRecursoDB->ejecutarAcceso($sqlNumeroContrato, "busqueda");
        $identificadorOrden = $resultado[0][0];
        $datos = array("numero_contrato" => $identificadorOrden,
            "vigencia" => date("Y"));
        
        if ($trans_Registro_contrato != false) {


                if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }else{
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                $c = 0;
                while ($c < count($SQLs)){
                    $SQLsDec[$c] = $this->miConfigurador->fabricaConexiones->crypto->codificar($SQLs[$c]['sql']);
                    $c++;
                }


                $query = json_encode($SQLsDec);


                $cadenaSQL = $this->miSql->getCadenaSql("tipo_contrato_find", $_REQUEST ['tipo_contrato']);
                $resultadoTipo = $esteRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');

                $contratoIden= array(
                    0 => $datos['numero_contrato'],
                    1 => $datos['vigencia']
                );

                $cadenaSQL = $this->miSql->getCadenaSql("consultarEstadoContrato", $contratoIden);
                $resultadoEst = $esteRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');
                
                $datosLog = array (
                        'tipo_log' => 'REGISTRO',
                        'tipo_contrato' => mb_strtoupper($resultadoTipo[0]['tipo_contrato'],'utf-8'),
                        'estado_contrato' => mb_strtoupper($resultadoEst[0]['nombre_estado'],'utf-8'),
                        'consecutivo_contrato' => $datos['numero_contrato'],
                        'vigencia' => $datos['vigencia'],
                        'query' => $query,
                        'host' => $ip,
                        'fecha_log' => date("Y-m-d H:i:s"),
                        'usuario' => $_REQUEST['usuario']
                );

                $cadenaSQL = $this->miSql->getCadenaSql("insertarLogContratoSuccess", $datosLog);
                $resultadoLog = $frameRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');

            redireccion::redireccionar("Inserto", $datos);
            exit;
        } else {

                if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }else{
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                $c = 0;
                while ($c < count($SQLs)){
                    $SQLsDec[$c] = $this->miConfigurador->fabricaConexiones->crypto->codificar($SQLs[$c]['sql']);
                    $c++;
                }


                $query = json_encode($SQLsDec);
                $error = json_encode(error_get_last());

                $cadenaSQL = $this->miSql->getCadenaSql("tipo_contrato_find", $_REQUEST ['tipo_contrato']);
                $resultadoTipo = $esteRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');

                $contratoIden= array(
                    0 => $datos['numero_contrato'],
                    1 => $datos['vigencia']
                );

                $cadenaSQL = $this->miSql->getCadenaSql("consultarEstadoContrato", $contratoIden);
                $resultadoEst = $esteRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');

                $datosLog = array (
                        'tipo_log' => 'REGISTRO',
                        'tipo_contrato' => mb_strtoupper($resultadoTipo[0]['tipo_contrato'],'utf-8'),
                        'estado_contrato' => mb_strtoupper($resultadoEst[0]['nombre_estado'],'utf-8'),
                        'consecutivo_contrato' => $datos['numero_contrato'],
                        'vigencia' => $datos['vigencia'],
                        'query' => $query,
                        'error' => $error,
                        'host' => $ip,
                        'fecha_log' => date("Y-m-d H:i:s"),
                        'usuario' => $_REQUEST['usuario']
                );

                $cadenaSQL = $this->miSql->getCadenaSql("insertarLogContratoError", $datosLog);
                $resultadoLog = $frameRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');
                $caso = "RC-" . date("Y") . "-" . $resultadoLog[0][0];
                $datos['caso'] = $caso;

            redireccion::redireccionar("ErrorRegistro", $datos);
            exit;
        }
    }

}

$miRegistrador = new RegistradorContrato($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>
