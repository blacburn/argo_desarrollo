<?php

namespace contratos\modificarContrato\funcion;

use contratos\modificarContrato\funcion\redireccion;

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

        $SQLs = [];
        $datos_modificados = array();
        $conexionFrame = "estructura";
        $frameRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrame);
        $conexion = "contractual";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        $conexionAgora = "agora";
        $esteRecursoDBAgora = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionAgora);

        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/gestionContractual/contratos/";
        $rutaBloque .= $esteBloque ['nombre'];
        $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/gestionContractual/contratos/" . $esteBloque ['nombre'];


        //Base de Información
        //-------------------------

            $datosContrato = array($_REQUEST ['numero_contrato'], $_REQUEST ['vigencia']);
            $cadena_sql = $this->miSql->getCadenaSql('Consultar_Contrato_Particular', $datosContrato);
            $contrato = $esteRecursoDB->ejecutarAcceso($cadena_sql, "busqueda");
            $contrato = $contrato [0];

            if ($contrato ['clase_contratista'] != '33') {
                $contrato ['clase_contratista'] = '32';
            }

            $arregloContrato = array(
                "numero_contrato" => $contrato ['numero_contrato'],
                "clase_contratista" => $contrato ['clase_contratista'],
                "clase_contrato" => $contrato ['tipologia_contrato'],
                "tipo_compromiso" => $contrato ['tipo_compromiso'],
                "plazo_ejecucion" => $contrato ['plazo_ejecucion'],
                "unidad_ejecucion_tiempo" => $contrato ['unidad_ejecucion'],
                "tipologia_especifica" => $contrato ['tipologia_contrato'],
                "tipo_contrato" => $contrato ['tipo_contrato'],
                "numero_constancia" => $contrato ['numero_constancia'],
                "modalidad_seleccion" => $contrato ['modalidad_seleccion'],
                "procedimiento" => $contrato ['procedimiento'],
                "regimen_contratación" => $contrato ['regimen_contratacion'],
                "tipo_moneda" => $contrato ['tipo_moneda'],
                "tipo_gasto" => $contrato ['tipo_gasto'],
                "origen_recursos" => $contrato ['origen_recursos'],
                "origen_presupuesto" => $contrato ['origen_presupueso'],
                "tema_gasto_inversion" => $contrato ['tema_gasto_inversion'],
                "valor_contrato_moneda_ex" => $contrato ['valor_contrato_me'],
                "tasa_cambio" => $contrato ['valor_tasa_cambio'],
                "observacionesContrato" => $contrato ['observaciones'],
                "tipo_control" => $contrato ['tipo_control'],
                "nombre_supervisor" => $contrato ['documento'] . "-" . $contrato['nombre'],
                "cargo_supervisor" => $contrato ['cargo'],
                "numero_convenio" => $contrato ['convenio'],
                "digito_supervisor" => $contrato ['digito_verificacion'],
                "formaPago" => $contrato ['forma_pago'],
                "clausula_presupuesto" => $contrato ['clausula_registro_presupuestal'],
                "objeto_contrato" => $contrato ['objeto_contrato'],
                "valor_contrato" => $contrato ['valor_contrato'],
                "dependencia_solicitante" => $contrato ['dependencia_solicitante'],
                "especificaciones_tecnicas" => $contrato ['especificaciones_tecnicas'],
                "actividades" => $contrato ['actividades'],
                "sede" => $contrato ['sede_solicitante'],
                "dependencia_supervisor" => $contrato ['dependencia_supervisor'],
                "sede_super" => $contrato ['sede_supervisor'],
                "justificacion" => $contrato ['justificacion'],
                "descripcion_forma_pago" => $contrato ['descripcion_forma_pago'],
                "condiciones" => $contrato ['condiciones'],
                "ordenador_gasto" => $contrato ['ordenador_gasto'],
                "convenio_solicitante" => $contrato ['convenio'],
                "ejecucionCiudad" => $contrato ['ciudad'],
                "sede_ejecucion" => $contrato ['sede'],
                "dependencia_ejecucion" => $contrato ['dependencia'],
                "direccion_ejecucion" => $contrato ['direccion'],
                "tipo_supervisor" => $contrato['tipo']
            );


        $cadenaSql = $this->miSql->getCadenaSql('consultaArrendamiento', $datosContrato);
        $arrendamiento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        $arrendamientoN = array(
            'destinacionArrendamiento_hidden' => $arrendamiento[0]['destinacion'],
            'diasHabiles_hidden' => $arrendamiento[0]['plazo_pago_mensual'],
            'valorMensualArrendamiento_hidden' => $arrendamiento[0]['valor_arrendamiento'],
            'reajusteArrendamiento_hidden' => $arrendamiento[0]['reajuste'],
            'diasHabilesAdmin_hidden' =>$arrendamiento[0]['plazo_administracion'],
            'valorAdmin_hidden' =>intval($arrendamiento[0]['valor_administracion']),
            'diasHabilesEntrega_hidden' => $arrendamiento[0]['plazo_entrega'],
            
        );


        $datosOld = array(
            'datosContrato' =>  $arregloContrato,
            'datosArrendamiento' => $arrendamientoN
        );

        //-------------------------



        //Validacion del tipo de compromiso, para determinar si el contrato 
        //tiene o no convenio asociado
        if ($_REQUEST ['tipo_compromiso'] != '3') {
            $numero_convenio = "";
        } else {
            $numero_convenio = $_REQUEST ['convenio_solicitante'];
        }
        //Validacion campos nulos de moneda , tasa extranjera y numero de constancia
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

        //Obtener la Clausula de Presupuesto
        if (isset($_POST['clausula_presupuesto'])) {
            $clausula_presupuesto = $_POST['clausula_presupuesto'];
        } else {
            $clausula_presupuesto = 'false';
        }


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

        //if ($_REQUEST['tipo_supervisor'] == 1) {
        $supervisor = $_REQUEST['nombre_supervisor'];
        /*
        } else {
            $supervisor = $_REQUEST['nombre_supervisor_interventor'];
        }
        */

        $infoSupervisor = explode("-", $supervisor);

        //Validar Supervisor 
        $SqlValidarSupervisor = $this->miSql->getCadenaSql('ObtenerSupervisor', $infoSupervisor[0]);
        $InfoSupervisorRegistrado = $esteRecursoDB->ejecutarAcceso($SqlValidarSupervisor, "busqueda");
        $datosSupervisor = array(
            'documento_supervisor' => $infoSupervisor[0],
            'nombre_supervisor' => $infoSupervisor[1],
            'cargo_supervisor' => $_REQUEST ['cargo_supervisor'],
            'sede_supervisor' => $_REQUEST ['sede_super'],
            'dependencia_supervisor' => $_REQUEST ['dependencia_supervisor'],
            'digito_verificacion_supervisor' => $_REQUEST ['digito_supervisor'],
        );


        $datos_modificados = array_merge($datos_modificados, $datosSupervisor);
        if ($InfoSupervisorRegistrado == false) {
            //Registro de supervisor si no existe
            $SqlSupervisorContrato['sql'] = $this->miSql->getCadenaSql('insertarSupervisor', $datosSupervisor);
            $SqlSupervisorContrato['descripcion'] = 'registroSupervisor';
            $SqlSupervisorContrato['valores'] = $datosSupervisor;
            array_push($SQLs, $SqlSupervisorContrato);


            $infoSupervisor[0] = "currval('supervisor_contrato_id_seq')";
        } else {

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
                $infoSupervisor[0] = "currval('supervisor_contrato_id_seq')";
                $SqlSupervisorContrato['sql'] = $this->miSql->getCadenaSql('insertarSupervisor', $datosSupervisor);
                $SqlSupervisorContrato['descripcion'] = 'registroSupervisor';
                $SqlSupervisorContrato['valores'] = $datosSupervisor;
                array_push($SQLs, $SqlSupervisorContrato);
            } else {

                $infoSupervisor[0] = $id_supervisor;
            }
        }


        $infoSupervisor[0] = $_REQUEST ['id_supervisor_hidden'];






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


        //Ejecucion del contrato
        $arreglo_info_ejecucion = array(
            'direccion_ejecucion' => $_REQUEST['direccion_ejecucion'],
            'sede_ejecucion' => $_REQUEST['sede_ejecucion'],
            'dependencia_ejecucion' => $_REQUEST['dependencia_ejecucion'],
            'ciudad_ejecucion' => $_REQUEST['ejecucionCiudad'],
            'lugar_ejecucion' => $_REQUEST['lugar_ejecucion'],
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

        $datos_modificados = array_merge($datos_modificados, $arreglo_info_ejecucion);
        //Datos Generales del  Contrato 
        $arreglo_contrato_general = array(
            'vigencia' => $_REQUEST['vigencia'],
            'numero_contrato' => $_REQUEST['numero_contrato'],
            'objeto_contrato' => $_REQUEST ['objeto_contrato'],
            'plazo_ejecucion' => $_REQUEST ['plazo_ejecucion'],
            'forma_pago' => $_REQUEST ['formaPago'],
            'ordenador_gasto' => $_REQUEST ['ordenador_gasto'],
            'clausula_presupuesto' => $clausula_presupuesto,
            'sede' => $_REQUEST ['sede'],
            'dependencia' => $_REQUEST ['dependencia_solicitante'],
            'contratista' => $_REQUEST['id_proveedor'],
            'unidad_ejecucion_tiempo' => $_REQUEST ['unidad_ejecucion_tiempo'],
            'valor_contrato' => $_REQUEST ['valor_contrato'],
            'justificacion' => $_REQUEST ['justificacion'],
            'actividades' => $_REQUEST ['actividades'],
            'condiciones' => $_REQUEST ['condiciones'],
            'especificaciones_tecnicas' => $_REQUEST ['especificaciones_tecnicas'],
            'descripcion_forma_pago' => $_REQUEST ['descripcion_forma_pago'],
            'unidad_ejecutora' => $_REQUEST ['unidad_ejecutora_hidden'],
            'tipologia_especifica' => $_REQUEST ['tipologia_especifica'],
            'tipo_contrato' => $_REQUEST ['tipo_contrato'],
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
            'lugar_ejecucion' => $lugarEjecucion,
            'supervisor' => $infoSupervisor[0],
            'clase_contratista' => $_REQUEST ['clase_contratista'],
            'convenio' => $numero_convenio,
        );


        $datos_modificados = array_merge($datos_modificados, $arreglo_contrato_general);


        $SqlcontratoGeneral['sql'] = $this->miSql->getCadenaSql('actualizarContratoGeneral', $arreglo_contrato_general);
        $SqlcontratoGeneral['descripcion'] = 'actualizarContratoGeneral';
        $SqlcontratoGeneral['valores'] = $arreglo_contrato_general;
        array_push($SQLs, $SqlcontratoGeneral);


        //Actualizar  Perfil --------------------------- Contrato CPS ---------------------------------------------
        $datosContrato = array($_REQUEST ['numero_contrato'], $_REQUEST ['vigencia']);
        $cadena_sql = $this->miSql->getCadenaSql('ConsultarperfilCPS', $datosContrato);
        $perfil = $esteRecursoDB->ejecutarAcceso($cadena_sql, "busqueda");


        if ($_REQUEST ['tipo_contrato'] != '6') {

            if ($perfil != false) {
                $SqlPerfilCPS['sql'] = $this->miSql->getCadenaSql('EliminarRelacionperfilCPS', $datosContrato);
                $SqlPerfilCPS['descripcion'] = 'EliminarRelacionperfilCPS';
                $SqlPerfilCPS['valores'] = $datosContrato;
                array_push($SQLs, $SqlPerfilCPS);
            }
        } else {

            $arreglo_perfil_cps = array(
                'vigencia' => $_REQUEST ['vigencia'],
                'perfil' => $_REQUEST ['perfil'],
                'numero_contrato' => $_REQUEST ['numero_contrato'],
            );

            if ($perfil == false) {

                $SqlPerfilCPS['sql'] = $this->miSql->getCadenaSql('insertarPerfilCPS', $arreglo_perfil_cps);
                $SqlPerfilCPS['descripcion'] = 'registroPerfilCPS';
                $SqlPerfilCPS['valores'] = $arreglo_perfil_cps;
                array_push($SQLs, $SqlPerfilCPS);
            } else {


                $SqlPerfilCPS['sql'] = $this->miSql->getCadenaSql('actualizarPerfilCPs', $arreglo_perfil_cps);
                $SqlPerfilCPS['descripcion'] = 'actualizarPerfilCPS';
                $SqlPerfilCPS['valores'] = $arreglo_perfil_cps;
                array_push($SQLs, $SqlPerfilCPS);
            }
        }


        //Actualizar CDP asociados al contrato

        $datos_contrato = array(
            'vigencia' => $_REQUEST['vigencia'],
            'numero_contrato' => $_REQUEST['numero_contrato'],
        );

        $sqlEliminarDisponibilidades['sql'] = $this->miSql->getCadenaSql('eliminarContratoDisponibilidad', $datos_contrato);
        $sqlEliminarDisponibilidades['descripcion'] = 'eliminarDisponibilidadesContrato';
        $sqlEliminarDisponibilidades['valores'] = $datos_contrato;
        array_push($SQLs, $sqlEliminarDisponibilidades);


        $disponibilidades = explode(",", substr($_REQUEST['indices_cdps_vigencias'], 1));

        for ($i = 0; $i < count($disponibilidades); $i++) {
            $datos = array(
                'numero_contrato' => $_REQUEST['numero_contrato'],
                'vigencia' => $_REQUEST['vigencia'],
                'numero_disponibilidad' => explode("-", $disponibilidades[$i])[0],
                'vigencia_disponibilidad' => explode("-", $disponibilidades[$i])[1],
            );

            $sqlDisponibilidad['sql'] = $this->miSql->getCadenaSql('insertarContratoDisponibilidad', $datos);
            $sqlDisponibilidad['descripcion'] = 'registrarDisponibilidadesContrato';
            $sqlDisponibilidad['valores'] = $datos;
            array_push($SQLs, $sqlDisponibilidad);
        }




        if (isset($_REQUEST['idnovedadModificacion'])) {


            $datos = "";

            $datos_modificados = json_encode($datos_modificados);

            $arreglo_json = array(
                2 => str_replace("\\", "", $_REQUEST['datosActualesContrato']),
                1 => $datos_modificados,
                0 => $_REQUEST['idnovedadModificacion']
            );
            $cadenaSqlDatosModificados = $this->miSql->getCadenaSql('insertarDatosModificados', $arreglo_json);
            array_push($SQLs, $cadenaSqlDatosModificados);

            $datosModificacion = array("numero_contrato" => $_REQUEST['numero_contrato'],
                "vigencia" => $_REQUEST['vigencia'],
                'idnovedadModificacion' => $_REQUEST['idnovedadModificacion'],
                'numero_contrato_suscrito' => $_REQUEST['numero_contrato_suscrito']);
        }


	 if ($_REQUEST ['tipo_contrato'] == '5') {


             
               $cadenaSql = $this->miSql->getCadenaSql('consultaArrendamiento', $datosContrato);
                $arrendamiento = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


                if ($arrendamiento != false) {

                     if ($_REQUEST ['diasHabilesAdmin_hidden'] == null || $_REQUEST ['valorAdmin_hidden'] == null) {
                    $arreglo_arrendamiento = array(
                        'destinacion' => $_REQUEST['destinacionArrendamiento_hidden'],
                        'plazo_mensual' => $_REQUEST ['diasHabiles_hidden'],
                        'reajuste' => $_REQUEST['reajusteArrendamiento_hidden'],
                        'plazo_entrega' => $_REQUEST ['diasHabilesEntrega_hidden'],
                        'valor_arrendamiento' => $_REQUEST ['valorMensualArrendamiento_hidden'],
                        'numero_contrato' => $datosContrato[0],
                        'vigencia' => $datosContrato[1],
                        'id_arrendamiento' => $arrendamiento[0][0],
                    );
                } else {
                    $arreglo_arrendamiento = array(
                        'destinacion' => $_REQUEST['destinacionArrendamiento_hidden'],
                        'plazo_mensual' => $_REQUEST ['diasHabiles_hidden'],
                        'reajuste' => $_REQUEST['reajusteArrendamiento_hidden'],
                        'plazo_admin' => $_REQUEST ['diasHabilesAdmin_hidden'],
                        'valor_admin' => $_REQUEST ['valorAdmin_hidden'],
                        'plazo_entrega' => $_REQUEST ['diasHabilesEntrega_hidden'],
                        'valor_arrendamiento' => $_REQUEST ['valorMensualArrendamiento_hidden'],
                        'numero_contrato' => $datosContrato[0],
                        'vigencia' => $datosContrato[1],
                        'id_arrendamiento' => $arrendamiento[0][0],
                    );
                }

                $SqContratoArrendamiento['sql'] = $this->miSql->getCadenaSql('actualizarContratoArrendamiento', $arreglo_arrendamiento);
                $SqContratoArrendamiento['descripcion'] = 'actualizarContratoArrendamiento';
                $SqContratoArrendamiento['valores'] = $arreglo_arrendamiento;
                array_push($SQLs, $SqContratoArrendamiento);

                }

                 
                 else{
                                 if ($_REQUEST ['diasHabilesAdmin_hidden'] == null || $_REQUEST ['valorAdmin_hidden'] == null) {
                                $arreglo_arrendamiento = array(
                                    'destinacion' => $_REQUEST['destinacionArrendamiento_hidden'],
                                    'plazo_mensual' => $_REQUEST ['diasHabiles_hidden'],
                                    'reajuste' => $_REQUEST['reajusteArrendamiento_hidden'],
                                    'plazo_entrega' => $_REQUEST ['diasHabilesEntrega_hidden'],
                                    'valor_arrendamiento' => $_REQUEST ['valorMensualArrendamiento_hidden'],
                                    'numero_contrato' => $datosContrato[0],
                                    'vigencia' => $datosContrato[1],
                                );
                                } else {
                                            $arreglo_arrendamiento = array(
                                                'destinacion' => $_REQUEST['destinacionArrendamiento_hidden'],
                                                'plazo_mensual' => $_REQUEST ['diasHabiles_hidden'],
                                                'reajuste' => $_REQUEST['reajusteArrendamiento_hidden'],
                                                'plazo_admin' => $_REQUEST ['diasHabilesAdmin_hidden'],
                                                'valor_admin' => $_REQUEST ['valorAdmin_hidden'],
                                                'plazo_entrega' => $_REQUEST ['diasHabilesEntrega_hidden'],
                                                'valor_arrendamiento' => $_REQUEST ['valorMensualArrendamiento_hidden'],
                                                'numero_contrato' => $datosContrato[0],
                                                'vigencia' => $datosContrato[1],
                                            );
                                }


                $SqContratoArrendamiento['sql'] = $this->miSql->getCadenaSql('insertarContratoArrendamiento', $arreglo_arrendamiento);
                $SqContratoArrendamiento['descripcion'] = 'insertarContratoArrendamiento';
                $SqContratoArrendamiento['valores'] = $arreglo_arrendamiento;
                array_push($SQLs, $SqContratoArrendamiento);

                }
                
             
            
           
            
            
        }
      ;

         $arreglo_eliminar = array(
            'numero_contrato' => $datosContrato[0],
            'vigencia' => $datosContrato[1]
        );


        $SqContratoArrendamientoEl['sql'] = $this->miSql->getCadenaSql('eliminarContratoArrendamientoGeneral', $arreglo_eliminar);
        $SqContratoArrendamientoEl['descripcion'] = 'eliminarContratoArrendamientoGeneral';
        $SqContratoArrendamientoEl['valores'] = $arreglo_eliminar;
        array_push($SQLs, $SqContratoArrendamientoEl);

        if ($_REQUEST['tablAmparos_hidden'] == '') {
            $_REQUEST['tablAmparos_hidden'] = 'N/A,0';
            $_REQUEST['tablaSuficiencia_hidden'] = 'N/A,0';
            $_REQUEST['tablaVigencia_hidden'] = '0,0';
        }


        $arrayAmparos = explode("~", $_REQUEST['tablAmparos_hidden']);
        $arraySuficiencia = explode("~", $_REQUEST['tablaSuficiencia_hidden']);
        $arrayVigencia = explode("~", $_REQUEST['tablaVigencia_hidden']);


        $count = 0;

        while ($count < $_REQUEST['cantidadAmparos_hidden']) {


            $arreglo_contratoGeneral = array(
                'numero_contrato' => $datosContrato[0],
                'vigencia_contrato' => $datosContrato[1],
                'amparo' => $arrayAmparos [$count],
                'suficiencia' => $arraySuficiencia [$count],
                'vigencia_amparo' => $arrayVigencia [$count],
            );



            $SqContratoArrendamientoGeneral['sql'] = $this->miSql->getCadenaSql('insertarContratoArrendamientoGeneral', $arreglo_contratoGeneral);
            $SqContratoArrendamientoGeneral['descripcion'] = 'insertarContratoArrendamientoGeneral';
            $SqContratoArrendamientoGeneral['valores'] = $arreglo_contratoGeneral;
            array_push($SQLs, $SqContratoArrendamientoGeneral);


            $count++;
        }

        $trans_Editar_contrato = $esteRecursoDB->transaccion($SQLs);

        if(isset($_REQUEST['miPaginaAct'])){
            $datos = array("numero_contrato" => $_REQUEST['numero_contrato'],
            "vigencia" => $_REQUEST['vigencia'], "miPaginaAct" => $_REQUEST['miPaginaAct'], "numero_contrato_suscrito" => $_REQUEST['numero_contrato_suscrito']);
        }else{
            $datos = array("numero_contrato" => $_REQUEST['numero_contrato'],
            "vigencia" => $_REQUEST['vigencia']);
        }


        if ($trans_Editar_contrato != false) {

            $cadenaVerificarTemp = $this->miSql->getCadenaSql('obtenerInfoTemporal', $_REQUEST["atributosContratoTempHidden"]);
            $infoTemp = $esteRecursoDB->ejecutarAcceso($cadenaVerificarTemp, "busqueda");
            if ($infoTemp != false) {
                $cadenaEliminarInfoTemporal = $this->miSql->getCadenaSql('eliminarInfoTemporal', $_REQUEST["atributosContratoTempHidden"]);
                $esteRecursoDB->ejecutarAcceso($cadenaEliminarInfoTemporal, "acceso");
            }
            if (isset($_REQUEST['idnovedadModificacion'])) {
                redireccion::redireccionar("novedaddeModificacion", $datosModificacion);
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


                $serial = serialize($datosOld);
                $dataSerial = array(
                    'dataSerialize' => $this->miConfigurador->fabricaConexiones->crypto->codificar($serial)
                );
                $data = json_encode($dataSerial);


                $cadenaSQL = $this->miSql->getCadenaSql("tipo_contrato_find", $_REQUEST ['tipo_contrato']);
                $resultadoTipo = $esteRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');

                $contratoIden= array(
                    0 => $_REQUEST['numero_contrato'],
                    1 => $_REQUEST['vigencia']
                );

                $cadenaSQL = $this->miSql->getCadenaSql("consultarEstadoContrato", $contratoIden);
                $resultadoEst = $esteRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');
                
                $datosLog = array (
                        'tipo_log' => 'MODIFICACION',
                        'tipo_contrato' => mb_strtoupper($resultadoTipo[0]['tipo_contrato'],'utf-8'),
                        'estado_contrato' => mb_strtoupper($resultadoEst[0]['nombre_estado'],'utf-8'),
                        'consecutivo_contrato' => $_REQUEST['numero_contrato'],
                        'vigencia' => $_REQUEST['vigencia'],
                        'query' => $query,
                        'data' => $data,
                        'host' => $ip,
                        'fecha_log' => date("Y-m-d H:i:s"),
                        'usuario' => $_REQUEST['usuario']
                );

                if(isset($_REQUEST['justificacion_hidden'])){
                    $datosLog['justificacion'] = $_REQUEST['justificacion_hidden'];
                }

                $cadenaSQL = $this->miSql->getCadenaSql("insertarLogContratoSuccess", $datosLog);
                $resultadoLog = $frameRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');

                redireccion::redireccionar("Actualizo", $datos);
            }

            exit();
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
                    0 => $_REQUEST['numero_contrato'],
                    1 => $_REQUEST['vigencia']
                );

                $cadenaSQL = $this->miSql->getCadenaSql("consultarEstadoContrato", $contratoIden);
                $resultadoEst = $esteRecursoDB->ejecutarAcceso($cadenaSQL, 'busqueda');

                $datosLog = array (
                        'tipo_log' => 'MODIFICACION',
                        'tipo_contrato' => mb_strtoupper($resultadoTipo[0]['tipo_contrato'],'utf-8'),
                        'estado_contrato' => mb_strtoupper($resultadoEst[0]['nombre_estado'],'utf-8'),
                        'consecutivo_contrato' => $_REQUEST['numero_contrato'],
                        'vigencia' => $_REQUEST['vigencia'],
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

                redireccion::redireccionar("NoActualizo", $datos);

            exit();
        }
    }

}

$miRegistrador = new RegistradorContrato($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>
