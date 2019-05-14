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

        $_REQUEST ['tiempo'] = time();

        // -------------------------------------------------------------------------------------------------
        $conexion = "contractual";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        // Limpia Items Tabla temporal
        // ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
        $esteCampo = $esteBloque ['nombre'];

        $atributos ['id'] = $esteCampo;
        $atributos ['nombre'] = $esteCampo;


        /**
         * Nuevo a partir de la versión 1.0.0.2, se utiliza para crear de manera rápida el js asociado a
         * validationEngine.
         */
        $atributos ['validar'] = false;

        // Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
        $atributos ['tipoFormulario'] = 'multipart/form-data';
        // Si no se coloca, entonces toma el valor predeterminado 'POST'
        $atributos ['metodo'] = 'POST';
        // Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
        $atributos ['action'] = 'index.php';
        $atributos ['titulo'] = $this->lenguaje->getCadena($esteCampo);
        // Si no se coloca, entonces toma el valor predeterminado.
        $atributos ['estilo'] = '';
        $atributos ['marco'] = true;
        $tab = 1;
        // ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
        // ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
        $atributos ['tipoEtiqueta'] = 'inicio';
        $atributos = array_merge($atributos);
        echo $this->miFormulario->formulario($atributos);
        // ---------------- SECCION: Controles del Formulario -----------------------------------------------
        $conexionFrameWork = "estructura";
        $DBFrameWork = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrameWork);
        $cadenaSqlUnidad = $this->miSql->getCadenaSql("obtenerInfoUsuario", $_REQUEST['usuario']);
        $unidad = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");

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
        $atributos ["leyenda"] = "Consultar Información Contractual - Gestión Actas de Inicio";
        echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);
        {




            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
            $esteCampo = 'tipo_acta_inicio';
            $atributos ['columnas'] = 1;
            $atributos ['nombre'] = $esteCampo;
            $atributos ['id'] = $esteCampo;
            $atributos ['evento'] = '';
            $atributos ['deshabilitado'] = false;
            $atributos ["etiquetaObligatorio"] = false;
            $atributos ['tab'] = $tab;
            $atributos ['tamanno'] = 1;
            $atributos ['estilo'] = 'jqueryui';
            $atributos ['validar'] = ' ';
            $atributos ['limitar'] = false;
            $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
            $atributos ['anchoEtiqueta'] = 213;
            if (isset($_REQUEST [$esteCampo])) {
                $atributos ['seleccion'] = $_REQUEST [$esteCampo];
            } else {
                $atributos ['seleccion'] = -1;
            }

            $matrizItems = array (
                        array ( 1, 'Gestión Actas de Contratos' ),
                        array ( 2, 'Gestión Actas de Novedades' )
            );

            $atributos ['matrizItems'] = $matrizItems;
            // Utilizar lo siguiente cuando no se pase un arreglo:
            //$atributos ['baseDatos'] = 'contractual';
            //$atributos ['cadena_sql'] = $this->miSql->getCadenaSql("vigencia_contrato");
            $atributos = array_merge($atributos, $atributosGlobales);

            echo $this->miFormulario->campoCuadroLista($atributos);
            unset($atributos);



            $esteCampo = "marcoContratos";
            $atributos ['id'] = $esteCampo;
            $atributos ["estilo"] = "jqueryui";
            $atributos ['tipoEtiqueta'] = 'inicio';
            $atributos ["leyenda"] = "Gestión Actas de Inicio para Contratos";
            echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);
            {


                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'vigencia_por_contrato';
                    $atributos ['columnas'] = 2;
                    $atributos ['nombre'] = $esteCampo;
                    $atributos ['id'] = $esteCampo;
                    $atributos ['evento'] = '';
                    $atributos ['deshabilitado'] = false;
                    $atributos ["etiquetaObligatorio"] = false;
                    $atributos ['tab'] = $tab;
                    $atributos ['tamanno'] = 1;
                    $atributos ['estilo'] = 'jqueryui';
                    $atributos ['validar'] = ' ';
                    $atributos ['limitar'] = false;
                    $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                    $atributos ['anchoEtiqueta'] = 213;
                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['seleccion'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['seleccion'] = 6;
                    }
                    // $atributos ['matrizItems'] = $matrizItems;
                    // Utilizar lo siguiente cuando no se pase un arreglo:
                    $atributos ['baseDatos'] = 'contractual';
                    $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("vigencia_contrato");
                    $atributos = array_merge($atributos, $atributosGlobales);

                    echo $this->miFormulario->campoCuadroLista($atributos);
                    unset($atributos);

                    if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {
                        $unidad[0]['identificacion'] = $_REQUEST['identificacion'];
                        $_REQUEST['usuario'] = $_REQUEST['identificacion'];
                        $id_usuario = $_REQUEST['identificacion'];
                    } else {

                        $id_usuario = $_REQUEST['usuario'];
                        $cadenaSqlUnidad = $this->miSql->getCadenaSql("obtenerInfoUsuario", $id_usuario);
                        $unidad = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");
                    }


                    $cadenaSql = $this->miSql->getCadenaSql('consultarInformacionSupervisor', $unidad[0]['identificacion']);
                    $info_supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                    if ($info_supervisor[0]['dependencia_supervisor'] == 'DEP39') {
                        $unidad = 2;
                    } else {
                        $unidad = 1;
                    }

                    $ids_dep = '';

                    for ($i = 0; $i < count($info_supervisor); $i++) {
                        $ids_dep .= "'" . $info_supervisor[$i]['dependencia_supervisor'] . "',";
                    }

                    $ids_dep = substr($ids_dep, 0, -1);

                    $arreglo = array(
                        'documento' => $info_supervisor[0]['documento'],
                        'dependencia' => $ids_dep,
                     );

                    $cadenaSql = $this->miSql->getCadenaSql('consultarInformacionSupervisorxDependencia', $arreglo);
                    $id_supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

                    $ids_super = '';

                    for ($i = 0; $i < count($id_supervisor); $i++) {
                        $ids_super .= "'" . $id_supervisor[$i]['id'] . "',";
                    }

                    $ids_super = substr($ids_super, 0, -1);
                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'consecutivo_por_contrato';
                    $atributos ['columnas'] = 2;
                    $atributos ['nombre'] = $esteCampo;
                    $atributos ['id'] = $esteCampo;
                    $atributos ['evento'] = '';
                    $atributos ['deshabilitado'] = false;
                    $atributos ["etiquetaObligatorio"] = false;
                    $atributos ['tab'] = $tab;
                    $atributos ['tamanno'] = 1;
                    $atributos ['estilo'] = 'jqueryui';
                    $atributos ['validar'] = ' ';
                    $atributos ['limitar'] = false;
                    $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                    $atributos ['anchoEtiqueta'] = 213;

                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['seleccion'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['seleccion'] = -1;
                    }

                    $tab ++;
                    
                    $arregloConsecutivo = array(
                        'ids_super' => $ids_super,
                        'unidad' => $unidad             
                        
                    );

                    $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("consecutivo_contrato", $arregloConsecutivo);
                    $matrizItems = $esteRecursoDB->ejecutarAcceso($atributos ['cadena_sql'], "busqueda");

                    if ($matrizItems) {
                        $atributos ['matrizItems'] = $matrizItems;
                    }

                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->campoCuadroLista($atributos);
                    unset($atributos);

                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'clase_contrato';
                    $atributos ['columnas'] = 2;
                    $atributos ['nombre'] = $esteCampo;
                    $atributos ['id'] = $esteCampo;
                    $atributos ['evento'] = '';
                    $atributos ['deshabilitado'] = false;
                    $atributos ["etiquetaObligatorio"] = false;
                    $atributos ['tab'] = $tab;
                    $atributos ['tamanno'] = 1;
                    $atributos ['estilo'] = 'jqueryui';
                    $atributos ['validar'] = ' ';
                    $atributos ['limitar'] = false;
                    $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                    $atributos ['anchoEtiqueta'] = 213;

                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['seleccion'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['seleccion'] = -1;
                    }

                    // $atributos ['matrizItems'] = $matrizItems;
                    // Utilizar lo siguiente cuando no se pase un arreglo:
                    $atributos ['baseDatos'] = 'contractual';
                    $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("tipo_contrato");
                    $tab ++;
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->campoCuadroLista($atributos);
                    unset($atributos);
                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'contratista';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['nombre'] = $esteCampo;
                    $atributos ['tipo'] = 'text';
                    $atributos ['estilo'] = 'jqueryui';
                    $atributos ['marco'] = true;
                    $atributos ['estiloMarco'] = '';
                    $atributos ["etiquetaObligatorio"] = false;
                    $atributos ['columnas'] = 1;
                    $atributos ['dobleLinea'] = 0;
                    $atributos ['tabIndex'] = $tab;
                    $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                    $atributos ['validar'] = '';
                    $atributos ['textoFondo'] = 'Ingrese Mínimo 3 Caracteres de Búsqueda';

                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['valor'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['valor'] = '';
                    }
                    $atributos ['titulo'] = $this->lenguaje->getCadena($esteCampo . 'Titulo');
                    $atributos ['deshabilitado'] = false;
                    $atributos ['tamanno'] = 50;
                    $atributos ['maximoTamanno'] = '';
                    $atributos ['anchoEtiqueta'] = 213;
                    $tab ++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->campoCuadroTexto($atributos);
                    unset($atributos);

                    $esteCampo = 'id_contratista';
                    $atributos ["id"] = $esteCampo; // No cambiar este nombre
                    $atributos ["tipo"] = "hidden";
                    $atributos ['estilo'] = '';
                    $atributos ["obligatorio"] = false;
                    $atributos ['marco'] = true;
                    $atributos ["etiqueta"] = "";
                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['valor'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['valor'] = '';
                    }
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->campoCuadroTexto($atributos);
                    unset($atributos);

                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'fecha_inicio_sub';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['nombre'] = $esteCampo;
                    $atributos ['tipo'] = 'text';
                    $atributos ['estilo'] = 'jqueryui';
                    $atributos ['marco'] = true;
                    $atributos ['estiloMarco'] = '';
                    // $atributos ["etiquetaObligatorio"] = true;
                    $atributos ['columnas'] = 2;
                    $atributos ['dobleLinea'] = 0;
                    $atributos ['tabIndex'] = $tab;
                    $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                    $atributos ['validar'] = '';

                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['valor'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['valor'] = '';
                    }
                    $atributos ['titulo'] = $this->lenguaje->getCadena($esteCampo . 'Titulo');
                    $atributos ['deshabilitado'] = true;
                    $atributos ['tamanno'] = 8;
                    $atributos ['maximoTamanno'] = '';
                    $atributos ['anchoEtiqueta'] = 213;
                    $tab ++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->campoCuadroTexto($atributos);

                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'fecha_final_sub';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['nombre'] = $esteCampo;
                    $atributos ['tipo'] = 'text';
                    $atributos ['estilo'] = 'jqueryui';
                    $atributos ['marco'] = true;
                    $atributos ['estiloMarco'] = '';
                    // $atributos ["etiquetaObligatorio"] = true;
                    $atributos ['columnas'] = 2;
                    $atributos ['dobleLinea'] = 0;
                    $atributos ['tabIndex'] = $tab;
                    $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                    $atributos ['validar'] = '';

                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['valor'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['valor'] = '';
                    }
                    $atributos ['titulo'] = $this->lenguaje->getCadena($esteCampo . 'Titulo');
                    $atributos ['deshabilitado'] = true;
                    $atributos ['tamanno'] = 8;
                    $atributos ['maximoTamanno'] = '';
                    $atributos ['anchoEtiqueta'] = 213;
                    $tab ++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->campoCuadroTexto($atributos);

                    unset($atributos);

            }
            echo $this->miFormulario->marcoAgrupacion("fin");



            $esteCampo = "marcoNovedades";
            $atributos ['id'] = $esteCampo;
            $atributos ["estilo"] = "jqueryui";
            $atributos ['tipoEtiqueta'] = 'inicio';
            $atributos ["leyenda"] = "Gestión Actas de Inicio para Novedades";
            echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);
            {

                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'vigencia_por_contrato_nov';
                    $atributos ['columnas'] = 2;
                    $atributos ['nombre'] = $esteCampo;
                    $atributos ['id'] = $esteCampo;
                    $atributos ['evento'] = '';
                    $atributos ['deshabilitado'] = false;
                    $atributos ["etiquetaObligatorio"] = false;
                    $atributos ['tab'] = $tab;
                    $atributos ['tamanno'] = 1;
                    $atributos ['estilo'] = 'jqueryui';
                    $atributos ['validar'] = ' ';
                    $atributos ['limitar'] = false;
                    $atributos ['etiqueta'] = $this->lenguaje->getCadena($esteCampo);
                    $atributos ['anchoEtiqueta'] = 213;
                    if (isset($_REQUEST [$esteCampo])) {
                        $atributos ['seleccion'] = $_REQUEST [$esteCampo];
                    } else {
                        $atributos ['seleccion'] = 6;
                    }
                    // $atributos ['matrizItems'] = $matrizItems;
                    // Utilizar lo siguiente cuando no se pase un arreglo:
                    $atributos ['baseDatos'] = 'contractual';
                    $atributos ['cadena_sql'] = $this->miSql->getCadenaSql("vigencia_contrato");
                    $atributos = array_merge($atributos, $atributosGlobales);

                    echo $this->miFormulario->campoCuadroLista($atributos);
                    unset($atributos);

            }
            echo $this->miFormulario->marcoAgrupacion("fin");


            $esteCampo = 'tipo_acceso';
            $atributos ['id'] = $esteCampo;
            $atributos ['nombre'] = $esteCampo;
            $atributos ['tipo'] = 'hidden';
            $atributos ['estilo'] = 'jqueryui';
            $atributos ['valor'] = "";
            $atributos ['deshabilitado'] = false;
            $tab ++;
            // Aplica atributos globales al control
            $atributos = array_merge($atributos, $atributosGlobales);
            echo $this->miFormulario->campoCuadroTexto($atributos);
            unset($atributos);


        }


        // ------------------Division para los botones-------------------------
        $atributos ["id"] = "botonesGestActa";
        $atributos ["estilo"] = "marcoBotones";
        echo $this->miFormulario->division("inicio", $atributos);

        // -----------------CONTROL: Botón ----------------------------------------------------------------
        $esteCampo = 'botonConsultar';
        $atributos ["id"] = $esteCampo;
        $atributos ["tabIndex"] = $tab;
        $atributos ["tipo"] = 'boton';
        // submit: no se coloca si se desea un tipo button genérico
        $atributos ['submit'] = true;
        $atributos ["estiloMarco"] = '';
        $atributos ["estiloBoton"] = 'jqueryui';
        // verificar: true para verificar el formulario antes de pasarlo al servidor.
        $atributos ["verificar"] = '';
        $atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
        $atributos ["valor"] = $this->lenguaje->getCadena($esteCampo);
        $atributos ['nombreFormulario'] = $esteBloque ['nombre'];
        $tab ++;

        // Aplica atributos globales al control
        $atributos = array_merge($atributos, $atributosGlobales);
        echo $this->miFormulario->campoBoton($atributos);
        // -----------------FIN CONTROL: Botón -----------------------------------------------------------
        // ---------------------------------------------------------
        // ------------------Fin Division para los botones-------------------------
        echo $this->miFormulario->division("fin");

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
//        $valorCodificado = "actionBloque=" . $esteBloque ["nombre"];
        $valorCodificado = "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
        $valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
        $valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
        $valorCodificado .= "&opcion=ConsultarContratos";
        $valorCodificado .= "&usuario=" . $_REQUEST ['usuario'];
        $valorCodificado .= "&usuarioC=" . $id_usuario;

        if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

            $valorCodificado .= "&accesoCondor=true";
        }

        /**
         * SARA permite que los nombres de los campos sean dinámicos.
         * Para ello utiliza la hora en que es creado el formulario para
         * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
         * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
         * (b) asociando el tiempo en que se está creando el formulario
         */
        $valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
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
