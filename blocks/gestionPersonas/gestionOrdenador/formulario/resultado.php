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
        $atributos ['titulo'] = '';
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
         */

            $conexion = "contractual";
            $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

            $conexionFrameWork = "estructura";
            $DBFrameWork = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrameWork);

        /*

            if (isset($_REQUEST ['id_contrato']) && $_REQUEST ['id_contrato'] != '') {
                $temporal = explode("-", $_REQUEST ['id_contrato']);
                $contrato = $temporal[0];
                $vigencia = substr($temporal[1], 1, -1);
            } else {
                $contrato = "";
                $vigencia = "";
            }

            if (isset($_REQUEST ['vigencia']) && $_REQUEST ['vigencia'] != '') {
                $vigencia = $_REQUEST ['vigencia'];
            } else {
                $vigencia = "";
            }

            if (isset($_REQUEST ['unidad_ejecutora_consulta']) && $_REQUEST ['unidad_ejecutora_consulta'] != '') {
                $unidad_ejecutora = $_REQUEST ['unidad_ejecutora_consulta'];
            } else {
                $unidad_ejecutora = '';
            }
        */
            $filt = 0;

            $id_usuario = $_REQUEST['usuario'];
            $cadenaSqlUnidad = $this->miSql->getCadenaSql("obtenerInfoUsuario", $id_usuario);
            $unidadEjecutora = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('consultarOrdenadorGeneral');
        $ordenador = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        //--------------------------------------------------------------------
        $cadenaSql = $this->miSql->getCadenaSql('consultarMayorIdOrd');
        $maxId = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $max = strlen($maxId[0][0]);
        //--------------------------------------------------------------------



        $cadenaSqlUnidad = $this->miSql->getCadenaSql("obtenerInformacionElaborador", $_REQUEST['usuario']);
        $usuarioIn = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");

        //$arreglo = serialize($arreglo);


        $miPaginaActual = $this->miConfigurador->getVariableConfiguracion('pagina');

        $directorio = $this->miConfigurador->getVariableConfiguracion("host");
        $directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
        $directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");

        $variable = "pagina=" . $miPaginaActual;
        $variable .= "&usuario=" . $_REQUEST ['usuario'];
        $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);


        echo "<div id='marcoDatosLoad' style='width: 100%;height: 900px'>
            <div style='width: 100%;height: 100px'>
            </div>
            <center><img src='" . $rutaBloque . "/css/images/loading.gif'".' width=20% height=20% vspace=15 hspace=3 >
            </center>
          </div>';
            
        // ---------------- SECCION: Controles del Formulario -----------------------------------------------

        $esteCampo = "marcoDatosBasicosPerCar";
        $atributos ['id'] = $esteCampo;
        $atributos ["estilo"] = "jqueryui";
        $atributos ['tipoEtiqueta'] = 'inicio';
        $atributos ["leyenda"] = "Parámetros Personas";
        echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);





            $tipo = 'information';
            $mensaje =  "<br>Módulo de <b>Gestión de Ordenadores </b>
            </br><center>
            </br><b>Usuario:</b> (" . $usuarioIn[0]['identificacion'] . " - " . $usuarioIn[0]['nombre'] . " " . $usuarioIn[0]['apellido'] . ")</center><br>";
            // ---------------- SECCION: Controles del Formulario -----------------------------------------------
            $esteCampo = 'mensaje';
            $atributos["id"] = $esteCampo; //Cambiar este nombre y el estilo si no se desea mostrar los mensajes animados
            $atributos["etiqueta"] = "";
            $atributos["estilo"] = "centrar";
            $atributos["tipo"] = $tipo;
            $atributos["mensaje"] = $mensaje;
            echo $this->miFormulario->cuadroMensaje($atributos);
            unset($atributos);


                $variableNuevo = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                $variableNuevo .= "&opcion=registrarOrdenador";
                if(isset($sedeCar)){$variableNuevo .= "&sede=" . $sedeCar;}
                if(isset($dependenciaCar)){$variableNuevo .= "&dependencia=" . $dependenciaCar;}
                $variableNuevo .= "&usuario=" . $_REQUEST ['usuario'];
                $variableNuevo .= "&tiempo=" . $_REQUEST['tiempo'];
                $variableNuevo = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variableNuevo, $directorio);

                echo "<div class='datagrid'><table width='100%' align='center'>
                                     <tr align='center'>
                                         <td align='center'>";
                            
                                                    
                                            $atributos["id"]="botonReg";
                                            $atributos["estilo"]="widget textoPequenno";
                                            echo $this->miFormulario->division("inicio",$atributos);
                                            {
                                                $enlace = "<a href='".$variableNuevo."'>";
                                                $enlace.="<img src='".$rutaBloque."/css/images/registro_p.png' width='25px'><br>Registrar Ordenador";
                                                $enlace.="</a><br><br>";
                                                echo $enlace;
                                            }
                                            //------------------Fin Division para los botones-------------------------
                                            echo $this->miFormulario->division("fin");
                                            unset ( $atributos );
                                                

                                         echo "   </td>
                                             </tr>
                                           </table></div> ";



       

        if ($ordenador) {

            $esteCampo = "marcoDatosBasicosPer";
            $atributos ['id'] = $esteCampo;
            $atributos ["estilo"] = "jqueryui";
            $atributos ['tipoEtiqueta'] = 'inicio';
            $atributos ["leyenda"] = "Supervisores de Contrato";
            echo $this->miFormulario->marcoAgrupacion('inicio', $atributos);


            echo '<table id="tablaOrdenadores">';

            echo "<thead>
                             <tr>
                                <th width='8%'><center>Identificador</center></th>
                                <th width='28%'><center>Nombre</center></th>            
                                <th width='8%'><center>Documento</center></th>            
                                <th width='24%'><center>Cargo</center></th>
                                <th width='8%'><center>Fecha Inicio</center></th>
                                <th width='8%'><center>Fecha Fin</center></th>
                                <th id='estateTab' width='8%'><center>Estado</center></th>
                                <th width='8%'><center>Gestionar</center></th>
                             </tr>
            </thead>
            <tbody>";

            foreach ($ordenador as $valor) {
                $variable = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
                $variable .= "&opcion=gestionarOrdenador";
                $variable .= "&id=" . $valor ['id'];
                $variable .= "&nombre=" . $valor ['nombre_ordenador'];
                $variable .= "&documento=" . $valor ['documento'];
                $variable .= "&rol=" . $valor ['rol_id'];
                $variable .= "&usuario=" . $_REQUEST ['usuario'];
                $variable .= "&tiempo=" . $_REQUEST['tiempo'];
                $variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($variable, $directorio);


                //------------------------------------ CAST ------------------------------------------------
                //------------------------------------------------------------------------------------------

                if($valor ['fecha_fin'] >= date ( 'Y-m-d' ) && $valor ['fecha_inicio'] <= date ( 'Y-m-d' ) ){
                    $valor ['estado'] = "ACTIVO";
                    $disable = false;
                }else{
                    $valor ['estado'] = "INACTIVO";
                    $disable = true;
                }

                if($valor ['fecha_inicio'] != null){
                    $dateI = new DateTime($valor ['fecha_inicio']);
                    $valor ['fecha_inicio'] = $dateI->format('d/m/Y');
                }
                
                if($valor ['fecha_fin'] != null){
                    $dateF = new DateTime($valor ['fecha_fin']);
                    $valor ['fecha_fin'] = $dateF->format('d/m/Y');
                }

                if($valor ['rol_id'] != null){
                    $cadenaSql = $this->miSql->getCadenaSql('cargosOrdenadorById', $valor ['rol_id']);
                    $carCast = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                    $valCarCast = $carCast[0][1];
                }else{
                    $valCarCast = '404!';
                }



                //------------------------------------------------------------------------------------------
                //------------------------------------------------------------------------------------------


                $mostrarHtml = "<tr>
                    <td><center>SUP-" . str_pad($valor ['id'], $max, "0", STR_PAD_LEFT) . "</center></td>
                    <td><center>" . $valor ['nombre_ordenador'] . "</center></td>";
                $mostrarHtml .= "<td><center>" . $valor['documento'] . "</td>";

                $mostrarHtml .= "<td><center>" . $valCarCast . "</td>";
        
                $mostrarHtml .="
                    <td><center>" . $valor ['fecha_inicio'] . "</center></td>";
                $mostrarHtml .="
                    <td><center>" . $valor ['fecha_fin'] . "</center></td>";
                $mostrarHtml .="
                    <td><center>" . $valor ['estado'] . "</center></td>";
                if($disable){
                    $mostrarHtml .="    <td><center>
                        <a href='javascript:void(0);'>
                            <img src='" . $rutaBloque . "/css/images/cancel2.png' width='15px'>
                        </a>
                    </center> </td>";
                }else{
                    $mostrarHtml .="    <td><center>
                        <a href='" . $variable . "'>
                            <img src='" . $rutaBloque . "/css/images/modificar.png' width='15px'>
                        </a>
                    </center> </td>";
                }
                $mostrarHtml .="</tr>";
                echo $mostrarHtml;
                unset($mostrarHtml);
                unset($variable);
            }

            echo "</tbody>";

            echo "</table>";

            echo $this->miFormulario->marcoAgrupacion('fin');

        } else {

            $mensaje = "No se encontraron <b>Supervisores</b> con las siguientes especificaciones:<br><br>";

            if(isset($valueSed)){
                $mensaje .= "<i>Sede</i>: <b>".$valueSed."</b><br>";
            }

            if(isset($valueDep)){
                $mensaje .= "<i>Dependencia</i>: <b>".$valueDep."</b><br>";
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