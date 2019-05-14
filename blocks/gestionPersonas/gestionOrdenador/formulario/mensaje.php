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

    function cambiafecha_format($fecha) {
        ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
        $fechana = $mifecha[3] . "/" . $mifecha[2] . "/" . $mifecha[1];
        return $fechana;
    }

    function miForm() {
        // Rescatar los datos de este bloque
        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

        $conexion = "contractual";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

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

        // -------------------------------------------------------------------------------------------------
        // Limpia Items Tabla temporal
        // $cadenaSql = $this->miSql->getCadenaSql ( 'limpiar_tabla_items' );
        // $resultado_secuancia = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
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
        echo $this->miFormulario->formulario($atributos); {
            // ---------------- SECCION: Controles del Formulario -----------------------------------------------

            $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

            $directorio = $this->miConfigurador->getVariableConfiguracion("host");
            $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
            $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");


            $esteCampo = "marcoDatosBasicos";
            $atributos ['id'] = $esteCampo;
            $atributos ["estilo"] = "jqueryui";
            $atributos ['tipoEtiqueta'] = 'inicio';
            echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);

            // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
            {


                if ($_REQUEST ['mensaje'] == 'registroOrdenador') {

                    $mensaje = "<h3>SE REGISTRÓ EL ORDENADOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>ROL:</b> " . $_REQUEST['rol'] . "<br><br>"
                            . " <b>RESOLUCION:</b> " . $_REQUEST['resolucion'] . "<br>"
                            . " <b>FECHA INICIO:</b> " . $this->cambiafecha_format($_REQUEST['fecha_inicio']) . "<br>"
                            . " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br><br>"
                            . " <b>FECHA DE REGISTRO:</b> " . $this->cambiafecha_format(date("Y-m-d")) . "<br>"
                            . " USUARIO QUE REALIZO EL REGISTRO: <b>" . $_REQUEST['usuario'] . "</b></h4><br>";

                    $mensaje .="<h2> EL ORDENADOR DE CONTRATO QUEDÓ REGISTRADO<br>";


                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'mensajeRegistro';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['tipo'] = 'success';
                    $atributos ['estilo'] = 'textoCentrar';
                    $atributos ['mensaje'] = $mensaje;

                    $tab ++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->cuadroMensaje($atributos);


                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);


                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }
                if ($_REQUEST ['mensaje'] == 'noRegistroOrdenador') {

                    $mensaje = "<h3>NO SE REGISTRÓ EL ORDENADOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>ROL:</b> " . $_REQUEST['rol'] . "<br><br>"
                            . " <b>RESOLUCION:</b> " . $_REQUEST['resolucion'] . "<br>"
                            . " <b>FECHA INICIO:</b> " . $this->cambiafecha_format($_REQUEST['fecha_inicio']) . "<br>"
                            . " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br>";
                            


                    $mensaje .="<h2> Verifiqué la Información he intente de nuevo.<br> ";
                    $mensaje .= "<br><br>Puede comunicarse con el Administrador del Sistema y reportar el caso <br> (" . $_REQUEST['digito'] . ")";

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

                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }


                if ($_REQUEST ['mensaje'] == 'registroSupervisor') {

                    $cadenaSql = $this->miSql->getCadenaSql('dependenciaSup', $_REQUEST['dependencia']);
                    $dep = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['dependencia'] = $dep[0][0];

                    $cadenaSql = $this->miSql->getCadenaSql('sedeSup', $_REQUEST['sede']);
                    $sed = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['sede'] = $sed[0][0];

                    $mensaje = "<h3>SE REGISTRÓ EL SUPERVISOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>CARGO:</b> " . $_REQUEST['cargo'] . "<br><br>"
                            . " <b>SEDE:</b> " . $_REQUEST['sede'] . "<br>"
                            . " <b>DEPENDENCIA:</b> " . $_REQUEST['dependencia'] . "<br>"
                            . " <b>FECHA INICIO:</b> " . $this->cambiafecha_format($_REQUEST['fecha_inicio']) . "<br>"
                            . " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br><br>"
                            . " <b>FECHA DE REGISTRO:</b> " . $this->cambiafecha_format(date("Y-m-d")) . "<br>"
                            . " USUARIO QUE REALIZO EL REGISTRO: <b>" . $_REQUEST['usuario'] . "</b></h4><br>";

                    $mensaje .="<h2> EL SUPERVISOR DE CONTRATO QUEDÓ REGISTRADO<br>";


                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'mensajeRegistro';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['tipo'] = 'success';
                    $atributos ['estilo'] = 'textoCentrar';
                    $atributos ['mensaje'] = $mensaje;

                    $tab ++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->cuadroMensaje($atributos);


                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);


                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }
                if ($_REQUEST ['mensaje'] == 'noRegistroSupervisor') {

                    $cadenaSql = $this->miSql->getCadenaSql('dependenciaSup', $_REQUEST['dependencia']);
                    $dep = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['dependencia'] = $dep[0][0];

                    $cadenaSql = $this->miSql->getCadenaSql('sedeSup', $_REQUEST['sede']);
                    $sed = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['sede'] = $sed[0][0];

                    $mensaje = "<h3>NO SE REGISTRÓ EL SUPERVISOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>CARGO:</b> " . $_REQUEST['cargo'] . "<br><br>"
                            . " <b>SEDE:</b> " . $_REQUEST['sede'] . "<br>"
                            . " <b>DEPENDENCIA:</b> " . $_REQUEST['dependencia'] . "<br>"
                            . " <b>FECHA INICIO:</b> " . $this->cambiafecha_format($_REQUEST['fecha_inicio']) . "<br>"
                            . " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br>";
                            


                    $mensaje .="<h2> Verifiqué la Información he intente de nuevo.<br> ";
                    $mensaje .= "<br><br>Puede comunicarse con el Administrador del Sistema y reportar el caso <br> (" . $_REQUEST['digito'] . ")";

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

                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }

                if ($_REQUEST ['mensaje'] == 'modificoSupervisor') {

                    $cadenaSql = $this->miSql->getCadenaSql('cargosFuncionarioById', $_REQUEST['cargo_id']);
                    $car = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['cargo_id'] = $car[0]['value'];

                    $cadenaSql = $this->miSql->getCadenaSql('dependenciaSup', $_REQUEST['dependencia']);
                    $dep = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['dependencia'] = $dep[0][0];

                    $cadenaSql = $this->miSql->getCadenaSql('sedeSup', $_REQUEST['sede']);
                    $sed = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['sede'] = $sed[0][0];

                    $mensaje = "<h3>SE MODIFICÓ EL SUPERVISOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>CARGO:</b> " . $_REQUEST['cargo_id'] . "<br><br>"
                            . " <b>SEDE:</b> " . $_REQUEST['sede'] . "<br>"
                            . " <b>DEPENDENCIA:</b> " . $_REQUEST['dependencia'] . "<br>";

                    if($_REQUEST['fecha_fin'] != null){
                        $mensaje .= " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br><br>";
                    }else{
                        $mensaje .= "<br>";
                    }
                    
                    $mensaje .= " <b>FECHA DE MODIFICACIÓN:</b> " . $this->cambiafecha_format(date("Y-m-d")) . "<br>"
                            . " USUARIO QUE REALIZO LA MODIFICACIÓN: <b>" . $_REQUEST['usuario'] . "</b></h4><br>";

                    $mensaje .="<h2> EL SUPERVISOR DE CONTRATO QUEDÓ MODIFICADO<br>";


                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'mensajeRegistro';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['tipo'] = 'success';
                    $atributos ['estilo'] = 'textoCentrar';
                    $atributos ['mensaje'] = $mensaje;

                    $tab ++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->cuadroMensaje($atributos);


                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);


                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }
                if ($_REQUEST ['mensaje'] == 'noModificoSupervisor') {

                    $cadenaSql = $this->miSql->getCadenaSql('cargosFuncionarioById', $_REQUEST['cargo_id']);
                    $car = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['cargo_id'] = $car[0]['value'];

                    $cadenaSql = $this->miSql->getCadenaSql('dependenciaSup', $_REQUEST['dependencia']);
                    $dep = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['dependencia'] = $dep[0][0];

                    $cadenaSql = $this->miSql->getCadenaSql('sedeSup', $_REQUEST['sede']);
                    $sed = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['sede'] = $sed[0][0];

                    $mensaje = "<h3>NO SE ḾODIFICÓ EL SUPERVISOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>CARGO:</b> " . $_REQUEST['cargo_id'] . "<br><br>"
                            . " <b>SEDE:</b> " . $_REQUEST['sede'] . "<br>"
                            . " <b>DEPENDENCIA:</b> " . $_REQUEST['dependencia'] . "<br>"
                            . " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br>";
                            


                    $mensaje .="<h2> Verifiqué la Información he intente de nuevo.<br> ";
                    $mensaje .= "<br><br>Puede comunicarse con el Administrador del Sistema y reportar el caso <br> (" . $_REQUEST['digito'] . ")";

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

                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }


                if ($_REQUEST ['mensaje'] == 'modificoOrdenador') {
                    
                    $cadenaSql = $this->miSql->getCadenaSql('rolesFuncionarioById', $_REQUEST['rol_id']);
                    $car = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['rol_id'] = $car[0]['value'];

                    $mensaje = "<h3>SE MODIFICÓ EL ORDENADOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>ROL:</b> " . $_REQUEST['rol_id'] . "<br><br>"
                            . " <b>RESOLUCION:</b> " . $_REQUEST['resolucion'] . "<br>";

                    if($_REQUEST['fecha_fin'] != null){
                        $mensaje .= " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br><br>";
                    }else{
                        $mensaje .= "<br>";
                    }
                    
                    $mensaje .= " <b>FECHA DE MODIFICACIÓN:</b> " . $this->cambiafecha_format(date("Y-m-d")) . "<br>"
                            . " USUARIO QUE REALIZO LA MODIFICACIÓN: <b>" . $_REQUEST['usuario'] . "</b></h4><br>";

                    $mensaje .="<h2> EL ORDENADOR DE CONTRATO QUEDÓ MODIFICADO<br>";


                    // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                    $esteCampo = 'mensajeRegistro';
                    $atributos ['id'] = $esteCampo;
                    $atributos ['tipo'] = 'success';
                    $atributos ['estilo'] = 'textoCentrar';
                    $atributos ['mensaje'] = $mensaje;

                    $tab ++;

                    // Aplica atributos globales al control
                    $atributos = array_merge($atributos, $atributosGlobales);
                    echo $this->miFormulario->cuadroMensaje($atributos);


                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);


                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }
                if ($_REQUEST ['mensaje'] == 'noModificoOrdenador') {
                    
                    $cadenaSql = $this->miSql->getCadenaSql('rolesFuncionarioById', $_REQUEST['rol_id']);
                    $car = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $_REQUEST['rol_id'] = $car[0]['value'];


                    $mensaje = "<h3>NO SE ḾODIFICÓ EL ORDENADOR</h3>"
                            . " <h4>DATOS </h4>" . $_REQUEST['nombre'] . "<br>"
                            . " <b>ROL:</b> " . $_REQUEST['rol_id'] . "<br><br>"
                            . " <b>RESOLUCION:</b> " . $_REQUEST['resolucion'] . "<br>"
                            . " <b>FECHA FIN:</b> " . $this->cambiafecha_format($_REQUEST['fecha_fin']) . "<br>";
                            


                    $mensaje .="<h2> Verifiqué la Información he intente de nuevo.<br> ";
                    $mensaje .= "<br><br>Puede comunicarse con el Administrador del Sistema y reportar el caso <br> (" . $_REQUEST['digito'] . ")";

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

                    $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                    $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);

                    // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------
                }

            }

            // ------------------Division para los botones-------------------------
            $atributos ["id"] = "botones";
            $atributos ["estilo"] = "marcoBotones";
            echo $this->miFormulario->division("inicio", $atributos);

            // -----------------CONTROL: Botón ----------------------------------------------------------------
            $esteCampo = 'botonContinuar';
            $atributos ['id'] = $esteCampo;
            $atributos ['enlace'] = $variable;
            $atributos ['tabIndex'] = 1;
            $atributos ['estilo'] = 'jqueryui';
            $atributos ['enlaceTexto'] = $this->lenguaje->getCadena($esteCampo);
            $atributos ['ancho'] = '10%';
            $atributos ['alto'] = '10%';
            $atributos ['redirLugar'] = true;
            echo $this->miFormulario->enlace($atributos);
            // -----------------FIN CONTROL: Botón -----------------------------------------------------------

            echo $this->miFormulario->marcoAgrupacion('fin');

            // ---------------- SECCION: División ----------------------------------------------------------
            $esteCampo = 'division1';
            $atributos ['id'] = $esteCampo;
            $atributos ['estilo'] = 'general';
            echo $this->miFormulario->division("inicio", $atributos);

            // ---------------- FIN SECCION: División ----------------------------------------------------------
            echo $this->miFormulario->division('fin');

            // ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
            // ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
            // Se debe declarar el mismo atributo de marco con que se inició el formulario.
        }

        // -----------------FIN CONTROL: Botón -----------------------------------------------------------
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

        $valorCodificado = "action=" . $esteBloque ["nombre"];
        $valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion('pagina');
        $valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
        $valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];

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

        $atributos ['marco'] = false;
        $atributos ['tipoEtiqueta'] = 'fin';
        echo $this->miFormulario->formulario($atributos);
    }

}

$miSeleccionador = new registrarForm($this->lenguaje, $this->miFormulario, $this->sql);

$miSeleccionador->miForm();
?>
