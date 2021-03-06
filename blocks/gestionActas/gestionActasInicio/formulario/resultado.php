<?php

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class registrarForm {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miSql;

    function __construct($lenguaje, $formulario, $sql) {
        $this->miConfigurador = \Configurador::singleton();

        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');

        $this->lenguaje = $lenguaje;

        $this->miFormulario = $formulario;

        $this->miSql = $sql;
    }

    function miForm() {



        // Rescatar los datos de este bloque
        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");
        $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

        $directorio = $this->miConfigurador->getVariableConfiguracion("host");
        $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
        $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");

        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
        $rutaBloque .= $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
        $rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];

        // ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
        /**
         * Atributos que deben ser aplicados a todos los controles de este formulario.
         * Se utiliza un arreglo
         * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
         *
         * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
         * $atributos= array_merge($atributos,$atributosGlobales);
         */
        $atributosGlobales ['campoSeguro'] = 'true';

        // ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
        $esteCampo = $esteBloque ['nombre'];
        $atributos ['id'] = $esteCampo;
        $atributos ['nombre'] = $esteCampo;
        // Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
        $atributos ['tipoFormulario'] = 'multipart/form-data';
        // Si no se coloca, entonces toma el valor predeterminado 'POST'
        $atributos ['metodo'] = 'POST';
        // Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
        $atributos ['action'] = 'index.php';
        // $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
        // Si no se coloca, entonces toma el valor predeterminado.
        $atributos ['estilo'] = '';
        $atributos ['marco'] = true;
        $tab = 1;
        // ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
        // ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
        $atributos ['tipoEtiqueta'] = 'inicio';
        echo $this->miFormulario->formulario($atributos);

        /*
         * PROCESAR VARIABLES DE CONSULTA
         */ {

            $conexion = "contractual";
            $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

            $conexionFrameWork = "estructura";
            $DBFrameWork = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrameWork);

            $conexionSICA = "sicapital";
            $DBSICA = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionSICA);

            if (isset($_REQUEST ['id_contrato']) && $_REQUEST ['id_contrato'] != '') {
                $temporal = explode("-", $_REQUEST ['id_contrato']);
                $contrato = $temporal[0];
                $vigencia = substr($temporal[1], 1, -1);
            } else {
                $contrato = "";
                $vigencia = "";
            }

            if (isset($_REQUEST ['consecutivo_por_contrato']) && $_REQUEST ['consecutivo_por_contrato'] != '') {
                $contrato = $_REQUEST ['consecutivo_por_contrato'];
            } else {
                $contrato = "";
            }

            if (isset($_REQUEST ['unidad_ejecutora_consulta']) && $_REQUEST ['unidad_ejecutora_consulta'] != '') {
                $unidad_ejecutora = $_REQUEST ['unidad_ejecutora_consulta'];
            } else {
                $unidad_ejecutora = '';
            }

            if (isset($_REQUEST ['clase_contrato']) && $_REQUEST ['clase_contrato'] != '') {
                $clase_contrato = $_REQUEST ['clase_contrato'];
            } else {
                $clase_contrato = '';
            }



            if (isset($_REQUEST ['id_contratista']) && $_REQUEST ['id_contratista'] != '') {
                $contratista = $_REQUEST ['id_contratista'];
            } else {
                $contratista = '';
            }


            if (isset($_REQUEST ['fecha_inicio_sub']) && $_REQUEST ['fecha_inicio_sub'] != '') {
                $fecha_inicio = $_REQUEST ['fecha_inicio_sub'];
            } else {
                $fecha_inicio = '';
            }

            if (isset($_REQUEST ['fecha_final_sub']) && $_REQUEST ['fecha_final_sub'] != '') {
                $fecha_final = $_REQUEST ['fecha_final_sub'];
            } else {
                $fecha_final = '';
            }

            if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {
                $supervisor = $_REQUEST['usuario'];



                $arreglo = array(
                    'clase_contrato' => $clase_contrato,
                    'numero_contrato' => $contrato,
                    'vigencia' => $vigencia,
                    'nit' => $contratista,
                    'fecha_inicial' => $fecha_inicio,
                    'fecha_final' => $fecha_final,
                    'vigencia_curso' => $_REQUEST['vigencia_por_contrato']
                );

                $cadenaSqlUnidad = $this->miSql->getCadenaSql("consultarContratosGeneralUE", $arreglo);
                $unidadEjecutora = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");
                $unidad_ejecutora_consulta = $unidadEjecutora[0]['unidad_ejecutora'];
            } else {

                $id_usuario = $_REQUEST['usuario'];
                $cadenaSqlUnidad = $this->miSql->getCadenaSql("obtenerInfoUsuario", $id_usuario);
                $unidadEjecutora = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");

                $unidad_ejecutora_consulta = $unidadEjecutora[0]['unidad_ejecutora'];

                $supervisor = $unidadEjecutora[0]['identificacion'];
            }






            $val_fallo = '';

            $cadenaSql = $this->miSql->getCadenaSql('consultarInformacionSupervisor', $supervisor);
            $info_supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


            $arreglo = array(
                'documento' => $info_supervisor[0]['documento'],
                'dependencia' => $info_supervisor[0]['dependencia_supervisor'],
            );

            $cadenaSql = $this->miSql->getCadenaSql('consultarInformacionSupervisorxDependencia', $arreglo);
            $id_supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            $ids_super = '';

            for ($i = 0; $i < count($id_supervisor); $i++) {
                $ids_super .= "'" . $id_supervisor[$i]['id'] . "',";
            }

            $ids_super = substr($ids_super, 0, -1);


            if ($id_supervisor) {

                $arreglo = array(
                    'clase_contrato' => $clase_contrato,
                    'numero_contrato' => $contrato,
                    'vigencia' => $vigencia,
                    'nit' => $contratista,
                    'fecha_inicial' => $fecha_inicio,
                    'fecha_final' => $fecha_final,
                    'unidad_ejecutora' => $unidad_ejecutora_consulta,
                    'vigencia_curso' => $_REQUEST['vigencia_por_contrato'],
                    'supervisor' => $ids_super,
                );

                $cadenaSql = $this->miSql->getCadenaSql('consultarContratosGeneral', $arreglo);

                $contratos = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");



                $arreglo = serialize($arreglo);
            } else {
                $contratos = false;
                $val_fallo = 'supervisor';
            }
        }





        $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

        $directorio = $this->miConfigurador->getVariableConfiguracion("host");
        $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
        $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");

        $variable = "pagina=" . $miPaginaActual;
        $variable .= "&usuario=" . $_REQUEST ['usuario'];
        $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

        // ---------------- SECCION: Controles del Formulario -----------------------------------------------
        if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {
            $atributos ["id"] = "logos";
            $atributos ["estilo"] = " ";
            echo $this->miFormulario->division("inicio", $atributos);
            unset($atributos);
            {

                $esteCampo = 'logo';
                $atributos ['id'] = $esteCampo;
                $atributos ['tabIndex'] = $tab;
                $atributos ['estilo'] = '';
                $atributos ['enlaceImagen'] = $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque') . 'css/images/banner_argo.jpg';
                $atributos ['ancho'] = '100%';
                $atributos ['alto'] = '150px';
                $tab ++;
                echo $this->miFormulario->enlace($atributos);
                unset($atributos);
            }

            echo $this->miFormulario->division("fin");
            unset($atributos);
        }
        $esteCampo = "marcoDatosBasicos";
        $atributos ['id'] = $esteCampo;
        $atributos ["estilo"] = "jqueryui";
        $atributos ['tipoEtiqueta'] = 'inicio';
        $atributos ["leyenda"] = "Contratos Suscritos - Acta de Inicio";
        echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);

        $variable = "pagina=" . $miPaginaActual;
        $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);
        $esteCampo = 'botonRegresar';
        $atributos ['id'] = $esteCampo;
        $atributos ['enlace'] = $variable;
        $atributos ['tabIndex'] = 1;
        $atributos ['estilo'] = 'textoSubtitulo';
        $atributos ['enlaceTexto'] = $this->lenguaje->getCadena($esteCampo);
        $atributos ['ancho'] = '10%';
        $atributos ['alto'] = '10%';
        $atributos ['redirLugar'] = true;
        echo $this->miFormulario->enlace($atributos);
        unset($atributos);
        echo "<br>";

        if ($contratos) {

            echo "<table id='tablaContratosAprobados'>";

            echo "<thead>
                             <tr>
                                <th><center>Vigencia</center></th>
                                <th><center>Número Contrato</center></th>            
                                <th><center>Tipo Contrato</center></th>            
            			<th><center>Contratista</center></th>
                                <th><center>Fecha Registro</center></th>
                                <th><center>Fecha Aprobado</center></th>
                                <th><center>Estado</center></th>
                                <th><center>Consultar Contrato</center></th>
                                <th><center>Registro Acta de Inicio</center></th>
                                <th><center>Actualizar Acta de Inicio</center></th>
                                <th><center>Fecha Inicio Acta</center></th>
                                <th><center>Fecha FIn Acta</center></th>
                                <th><center>Documento<input type='text' name='fuentedocumento' placeholder='Tamaño Fuente' id='fuentedocumento'></th>
                             </tr>
            </thead>
            <tbody>";

            foreach ($contratos as $valor) {

                //-------------------------- INICIO CONTROLES PARA TABLA 


                $variable = "pagina=consultaContratosAprobados"; // pendiente la pagina para modificar parametro
                $variable .= "&opcion=consultarContrato";
                $variable .= "&consultaSupervisor=TRUE";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&mensaje_titulo= --> Contrato: " . $valor ['tipo_contrato'] . " | VIGENCIA: " . $valor ['vigencia'] . " | NÚMERO CONTRATO : " . $valor ['numero_contrato_suscrito'];
                $variable .= "&arreglo=" . $arreglo;
                $variable .= "&usuario=" . $_REQUEST ['usuario'];
                $variable .= "&tiempo=" . $_REQUEST['tiempo'];
                if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

                    $variable .= "&accesoCondor=true";
                }




                $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);




                if (($valor['tipo_contrato'] == 'Contrato de Prestación de Servicios' && $valor['nombre_estado'] == 'Suscrito') || ($valor['tipo_contrato'] == 'Contrato de Prestación de Servicios Profesionales o Apoyo a la Gestión' && $valor['nombre_estado'] == 'Suscrito')) {


                    $cadenaSql = $this->miSql->getCadenaSql('consultarActasxContratista', $valor['proveedor']);
                    $fecha_fin = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                    $cadenaSql = $this->miSql->getCadenaSql('consultarFechaFinActa2', $fecha_fin[0]['id']);
                    $fecha_fin_acta = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                    $datosContratoCDP = array(0 => $valor ['numero_contrato'], 1 => $valor ['vigencia']);

                    $cadenaSql = $this->miSql->getCadenaSql('ConsultarDisponibilidadesContratoRP', $datosContratoCDP);
                    $cdp_contrato = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


                    $datos = array(0 => $cdp_contrato[0]['numero_cdp'],
                        1 => $cdp_contrato[0]['vigencia_cdp'],
                        2 => '1'
                    );

                    $cadenaSql = $this->miSql->getCadenaSql('consultarRegistroDisponibilidad', $datos);
                    $resultadoRps = $DBSICA->ejecutarAcceso($cadenaSql, "busqueda");

                    if ($fecha_fin[0]['fecha_fin']) {





//                        if (date('Y-m-d') <= $fecha_fin[0]['fecha_fin'] ) {

                        if (date('Y-m-d') <= $fecha_fin[0]['fecha_fin'] || !$resultadoRps) {

                            if (!$resultadoRps) {
                                $acta_inicio = "<a href='javascript:void(0);' onclick='VerInfoRegistroActaInicioRP(" . $valor ['proveedor'] . ");'> <img src='" . $rutaBloque . "/css/images/acta_inicio.png' width='15px'></a>";
                            } else {
                                $acta_inicio = "<a href='javascript:void(0);' onclick='VerInfoRegistroActaInicio(" . $valor ['proveedor'] . ");'> <img src='" . $rutaBloque . "/css/images/acta_inicio.png' width='15px'></a>";
                            }
                        } else {
                            $variable_acta_inicio = "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
                            $variable_acta_inicio .= "&opcion=actainicio";
                            $variable_acta_inicio .= "&vigencia=" . $valor ['vigencia'];
                            $variable_acta_inicio .= "&arreglo=" . $arreglo;
                            if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

                                $variable_acta_inicio .= "&accesoCondor=true";
                            }

                            $variable_acta_inicio .= "&numero_contrato=" . $valor ['numero_contrato'];
                            $variable_acta_inicio .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                            $variable_acta_inicio .= "&usuario=" . $_REQUEST ['usuario'];
                            $variable_acta_inicio .= "&mensaje_titulo= --> Contrato: " . $valor ['tipo_contrato'] . " | VIGENCIA: " . $valor ['vigencia'] . " | NÚMERO CONTRATO : " . $valor ['numero_contrato_suscrito'];
                            $variable_acta_inicio = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable_acta_inicio, $directorio);

                            $acta_inicio = "<a href='" . $variable_acta_inicio . "'><img src='" . $rutaBloque . "/css/images/acta_inicio.png' width='15px'></a>";
                        }
                    } else {




                        if (date('Y-m-d') <= $fecha_fin_acta[0][0] || !$resultadoRps) {
//                            if (date('Y-m-d') <= $fecha_fin_acta[0][0]) {

                            if (!$resultadoRps) {
                                $acta_inicio = "<a href='javascript:void(0);' onclick='VerInfoRegistroActaInicioRP(" . $valor ['proveedor'] . ");'> <img src='" . $rutaBloque . "/css/images/acta_inicio.png' width='15px'></a>";
                            } else {
                                $acta_inicio = "<a href='javascript:void(0);' onclick='VerInfoRegistroActaInicio(" . $valor ['proveedor'] . ");'> <img src='" . $rutaBloque . "/css/images/acta_inicio.png' width='15px'></a>";
                            }
                        } else {


                            $variable_acta_inicio = "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
                            $variable_acta_inicio .= "&opcion=actainicio";
                            $variable_acta_inicio .= "&vigencia=" . $valor ['vigencia'];
                            $variable_acta_inicio .= "&arreglo=" . $arreglo;
                            if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

                                $variable_acta_inicio .= "&accesoCondor=true";
                            }

                            $variable_acta_inicio .= "&numero_contrato=" . $valor ['numero_contrato'];
                            $variable_acta_inicio .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                            $variable_acta_inicio .= "&usuario=" . $_REQUEST ['usuario'];
                            $variable_acta_inicio .= "&mensaje_titulo= --> Contrato: " . $valor ['tipo_contrato'] . " | VIGENCIA: " . $valor ['vigencia'] . " | NÚMERO CONTRATO : " . $valor ['numero_contrato_suscrito'];
                            $variable_acta_inicio = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable_acta_inicio, $directorio);

                            $acta_inicio = "<a href='" . $variable_acta_inicio . "'><img src='" . $rutaBloque . "/css/images/acta_inicio.png' width='15px'></a>";
                        }
                    }
                    $mod_acta_inicio = "<a><img src='" . $rutaBloque . "/css/images/inhabilitado.png' width='15px'></a>";
                } else {

                    $variable_mod_acta_inicio = "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
                    $variable_mod_acta_inicio .= "&opcion=modactainicio";
                    $variable_mod_acta_inicio .= "&vigencia=" . $valor ['vigencia'];
                    $variable_mod_acta_inicio .= "&arreglo=" . $arreglo;
                    if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

                                $variable_acta_inicio .= "&accesoCondor=true";
                    }

                    $variable_mod_acta_inicio .= "&numero_contrato=" . $valor ['numero_contrato'];
                    $variable_mod_acta_inicio .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                    $variable_mod_acta_inicio .= "&usuario=" . $_REQUEST ['usuario'];
                    $variable_mod_acta_inicio .= "&mensaje_titulo= --> Contrato: " . $valor ['tipo_contrato'] . " | VIGENCIA: " . $valor ['vigencia'] . " | NÚMERO CONTRATO : " . $valor ['numero_contrato_suscrito'];
                    $variable_mod_acta_inicio = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable_mod_acta_inicio, $directorio);

                    $mod_acta_inicio = "<a href='" . $variable_mod_acta_inicio . "'><img src='" . $rutaBloque . "/css/images/consulta.png' width='15px'></a>";


                    $acta_inicio = "<a><img src='" . $rutaBloque . "/css/images/inhabilitado.png' width='15px'></a>";
                }




                $fecha_inicio_acta = "";
                $fecha_fin_acta = "";
                $validacion_doc_act = 0;

                if ($valor['nombre_estado'] === 'En ejecucion') {

                    $arreglo_consulta = array(
                        'numero_contrato' => $valor ['numero_contrato'],
                        'vigencia' => $valor ['vigencia']
                    );

                    $cadenaSql = $this->miSql->getCadenaSql('consultarActasInicio', $arreglo_consulta);
                    $actas_inicio = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


                    if ($actas_inicio !== false) {

                        $fecha_inicio_acta = $actas_inicio[0]['fecha_inicio'];

                        $cadenaSql = $this->miSql->getCadenaSql('consultarFechaFinActa', $arreglo_consulta);
                        $fecha_fin_acta = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                        $actas_inicio[0]['fecha_fin'] = $fecha_fin_acta[0][0];

                        $fecha_fin_acta = $actas_inicio[0]['fecha_fin'];
                        $validacion_doc_act = 1;
                    }
                }

                if ($valor['nombre_estado'] === 'Finalizado(Anticipado)' || $valor['nombre_estado'] === 'Anulado' || $valor['nombre_estado'] === 'Finalizado' || $valor['nombre_estado'] === 'Cancelado') {

                    $arreglo_consulta = array(
                        'numero_contrato' => $valor ['numero_contrato'],
                        'vigencia' => $valor ['vigencia']
                    );

                    $cadenaSql = $this->miSql->getCadenaSql('consultarActasInicio', $arreglo_consulta);
                    $actas_inicio = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


                    if ($actas_inicio !== false) {

                        $fecha_inicio_acta = $actas_inicio[0]['fecha_inicio'];

                        $fecha_fin_acta = $actas_inicio[0]['fecha_fin'];
                        $validacion_doc_act = 1;
                    }
                }


                if ($validacion_doc_act == 1) {

                    $variable_documento = "action=modificarContrato";
                    $variable_documento .= "&pagina=modificarContrato";
                    $variable_documento .= "&bloque=modificarContrato";
                    $variable_documento .= "&bloqueGrupo=gestionContractual/contratos/";
                    $variable_documento .= "&opcion=generarDocumento";
                    $variable_documento .= "&numero_contrato=" . $valor ['numero_contrato'];
                    $variable_documento .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                    $variable_documento .= "&vigencia=" . $valor ['vigencia'];
                    $variable_documento .= "&usuario=" . $_REQUEST['usuario'];
                    $variable_documento .= "&tipo_contrato=" . $valor ['tipo_contrato'];
                    $variable_documento .= "&unidad=" . $unidadEjecutora[0]['unidad_ejecutora'];
                    $variable_documento .= "&opcion=generarDocumento";
                    if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

                                $variable_documento .= "&accesoCondor=true";
                    }

                    $variable_documento = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable_documento, $directorio);

                    $documento = "<a href='javascript:void(0);' onclick='GenerarDocumento(" . $valor ['vigencia'] . $valor ['numero_contrato'] . ");'><img src='" . $rutaBloque . "/css/images/documento.png' width='15px'> </a>";
                } else {
                    $documento = "<a><img src='" . $rutaBloque . "/css/images/inhabilitado.png' width='15px'></a>";
                }


//-------------------------- FIN CONTROLES PARA TABLA 

                $mostrarHtml = "<tr>
                    <td><center>" . $valor ['vigencia'] . "</center></td>
                    <td><center>" . $valor ['numero_contrato_suscrito'] . "</center></td>";
                if ($valor["convenio"] == '') {
                    $mostrarHtml .= "<td><center>" . $valor['tipo_contrato'] . "</td>";
                } else {
                    $mostrarHtml .= "<td><center>" . $valor ['tipo_contrato'] . "<a href='javascript:void(0);' onclick='VerInfoConvenio(" . $valor ['convenio'] . ");'> (Convenio)</a></center></td>";
                }
                if ($valor["clase_contratista"] == '33') {
                    $mostrarHtml .= "<td><center><a href='javascript:void(0);' onclick='VerInfoContratista(" . $valor ['proveedor'] . ");'> Información Contratista</a></center></td>";
                } else {
                    $mostrarHtml .= "<td><center><a href='javascript:void(0);' onclick='VerInfoSociedadTemporal(" . $valor ['proveedor'] . ");'> Información Contratista</a></center></td>";
                }
                $mostrarHtml .="
                    <td><center>" . $valor ['fecha_registro'] . "</center></td>";
                $mostrarHtml .="
                    <td><center>" . $valor ['fecha_suscripcion'] . "</center></td>";
                $mostrarHtml .="
                    <td><center>" . $valor ['nombre_estado'] . "</center></td>
                    <td><center>
                    	<a href='" . $variable . "'>
                            <img src='" . $rutaBloque . "/css/images/consulta.png' width='15px'>
                        </a>
                  	</center> </td>";

                $mostrarHtml .= "<td><center>" . $acta_inicio . "</center> </td>";
                $mostrarHtml .= "<td><center>" . $mod_acta_inicio . "</center> </td>";

                $mostrarHtml .= "<td><center>" . $fecha_inicio_acta . "</center> </td>";


                $mostrarHtml .="<td><center>" . $fecha_fin_acta . "</center> </td> 
                               <td><center>" . $documento . "</center> </td>      
                         </tr>";
                echo $mostrarHtml;
                unset($mostrarHtml);
                unset($variable);
            }

            echo "</tbody>";

            echo "</table>";


            $atributos ["id"] = "ventanaEmergenteContratista";
            $atributos ["estilo"] = " ";
            echo $this->miFormulario->division("inicio", $atributos);

            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
            $esteCampo = 'infoContratista';
            $atributos ['id'] = $esteCampo;
            $atributos ['tipo'] = 'information';
            $atributos ['estilo'] = 'textoNotasFormulario';
            $atributos ['mensaje'] = "";
            $atributos ['span'] = "spandid";

            $tab ++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->cuadroMensaje($atributos);
            unset($atributos);

            echo $this->miFormulario->division("fin");
            unset($atributos);

            $atributos ["id"] = "ventanaEmergenteActaInicio";
            $atributos ["estilo"] = " ";
            echo $this->miFormulario->division("inicio", $atributos);

            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
            $esteCampo = 'infoActaInicio';
            $atributos ['id'] = $esteCampo;
            $atributos ['tipo'] = 'information';
            $atributos ['estilo'] = 'textoNotasFormulario';
            $atributos ['mensaje'] = "";
            $atributos ['span'] = "spandid2";

            $tab ++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->cuadroMensaje($atributos);
            unset($atributos);

            echo $this->miFormulario->division("fin");
            unset($atributos);



//            $atributos ["id"] = "ventanaEmergenteActaInicio";
//            $atributos ["estilo"] = " ";
//            echo $this->miFormulario->division("inicio", $atributos);
            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
//            $esteCampo = 'infoActaInicio';
//            $atributos ['id'] = $esteCampo;
//            $atributos ['tipo'] = 'information';
//            $atributos ['estilo'] = 'textoNotasFormulario';
//            $atributos ['mensaje'] = "";
//            $atributos ['span'] = "spandid2";
//
//            $tab ++;
//
//            // Aplica atributos globales al control
//            $atributos = array_merge($atributos, $atributosGlobales);
//            echo $this->miFormulario->cuadroMensaje($atributos);
//            unset($atributos);
//
//            echo $this->miFormulario->division("fin");
//            unset($atributos);
        } else {

            if ($val_fallo == 'supervisor') {

                $mensaje = "No Se Encontraron Contratos a su Supervisión<br>ó es posible que no se Encuentre como Supervisor Activo";
            } else {

                $mensaje = "No Se Encontraron Contratos<br>Verifique los Parametros de Busqueda";
            }



            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
            $esteCampo = 'mensajeRegistro';
            $atributos ['id'] = $esteCampo;
            $atributos ['tipo'] = 'error';
            $atributos ['estilo'] = 'textoCentrar';
            $atributos ['mensaje'] = $mensaje;

            $tab ++;

            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->cuadroMensaje($atributos);
            // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
        }

        echo $this->miFormulario->marcoAgrupacion('fin');

        // ------------------- SECCION: Paso de variables ------------------------------------------------

        /**
         * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
         * SARA permite realizar esto a través de tres
         * mecanismos:
         * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
         * la base de datos.
         * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
         * formsara, cuyo valor será una cadena codificada que contiene las variables.
         * (c) a través de campos ocultos en los formularios. (deprecated)
         */
        // En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
        // Paso 1: crear el listado de variables

        $valorCodificado = "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
        $valorCodificado .= "&opcion=aprobarContratoMultiple";
        /**
         * SARA permite que los nombres de los campos sean dinámicos.
         * Para ello utiliza la hora en que es creado el formulario para
         * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
         * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
         * (b) asociando el tiempo en que se está creando el formulario
         */
        $valorCodificado .= "&tiempo=" . time();
        // Paso 2: codificar la cadena resultante
        $valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar($valorCodificado);

        $atributos ["id"] = "formSaraData"; // No cambiar este nombre
        $atributos ["tipo"] = "hidden";
        $atributos ['estilo'] = '';
        $atributos ["obligatorio"] = false;
        $atributos ['marco'] = true;
        $atributos ["etiqueta"] = "";
        $atributos ["valor"] = $valorCodificado;
        echo $this->miFormulario->campoCuadroTexto($atributos);
        unset($atributos);

        $atributos ['marco'] = true;
        $atributos ['tipoEtiqueta'] = 'fin';
        echo $this->miFormulario->formulario($atributos);
    }

}

$miSeleccionador = new registrarForm($this->lenguaje, $this->miFormulario, $this->sql);

$miSeleccionador->miForm();
?>
