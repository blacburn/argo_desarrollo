<?php

namespace contratos\modificarContrato;

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/builder/InspectorHTML.class.php");
include_once ("core/builder/Mensaje.class.php");
include_once ("core/crypto/Encriptador.class.php");

// Esta clase contiene la logica de negocio del bloque y extiende a la clase funcion general la cual encapsula los
// metodos mas utilizados en la aplicacion
// Para evitar redefiniciones de clases el nombre de la clase del archivo funcion debe corresponder al nombre del bloque
// en camel case precedido por la palabra Funcion
class Funcion {

    var $sql;
    var $funcion;
    var $lenguaje;
    var $ruta;
    var $miConfigurador;
    var $miInspectorHTML;
    var $error;
    var $miRecursoDB;
    var
            $crypto;

    function funcionEjemplo() {
        include_once ($this->ruta . "/funcion/funcionEjemplo.php");
    }

    function procesarAjax() {
        include_once ($this->ruta . "funcion/procesarAjax.php");
    }

    function modificar() {
        include_once ($this->ruta . "funcion/modificar.php");
    }

    function modificarElementos() {
        include_once ($this->ruta . "funcion/procesarModificarElementos.php");
    }

    function modificarServicio() {
        include_once ($this->ruta . "funcion/modificarServicio.php");
    }

    function eliminarElementoOrden() {
        include_once ($this->ruta . "funcion/procesareliminarElemento.php");
    }

    function eliminarServicio() {
        include_once ($this->ruta . "funcion/eliminarServicio.php");
    }

    function generarDocumento() {

    if ($_REQUEST['tipo_contrato'] == 'Contrato Interadministrativo') {
            include_once ($this->ruta . "funcion/documentoPdfInteradministrativo.php");
            exit;
    }     
    if ($_REQUEST['tipo_contrato'] == 'Contrato de Obra') {
            include_once ($this->ruta . "funcion/documentoPdfObra.php");
            exit;
        } 
    if ($_REQUEST['tipo_contrato'] == 'Contrato de Suministro') {
            include_once ($this->ruta . "funcion/documentoPdfSuministro.php");
            exit;
        }       
	if ($_REQUEST['tipo_contrato'] == 'Contrato de  Arrendamiento') {
            include_once ($this->ruta . "funcion/documentoPdfContratoArrendamiento.php");
            exit;
        }
    if ($_REQUEST['tipo_contrato'] == 'Contrato de Compra-Venta') {
            include_once ($this->ruta . "funcion/documentoPdfContratoCompraVenta.php");
            exit;
        }    
	if ($_REQUEST['tipo_contrato'] == 'Contrato de Prestación de Servicios' || $_REQUEST['tipo_contrato'] =='Contrato de Prestación de Servicios Profesionales o Apoyo a la Gestión') {
            include_once ($this->ruta . "funcion/documentoPdfContratoPrestacionServicios" . $_REQUEST['unidad'] . ".php");
            exit;
        } 
    else {
            include_once ($this->ruta . "funcion/documentoPdfSinFormato.php");
        }

       
    }

    function aprobarContrato() {
        include_once ($this->ruta . "funcion/aprobarContrato.php");
    }

    function action() {

        //
        // Evitar qu44444444rrrre se ingrese codigo HTML y PHP en los campos de texto
        // Campos que se quieren excluir de la limpieza de código. Formato: nombreCampo1|nombreCampo2|nombreCampo3
        $excluir = "";
        $_REQUEST = $this->miInspectorHTML->limpiarPHPHTML($_REQUEST);

        // Aquí se coloca el código que procesará los diferentes formularios que pertenecen al bloque
        // aunque el código fuente puede ir directamente en este script, para facilitar el mantenimiento
        // se recomienda que aqui solo sea el punto de entrada para incluir otros scripts que estarán
        // en la carpeta funcion
        // Importante: Es adecuado que sea una variable llamada opcion o action la que guie el procesamiento:
        if (isset($_REQUEST ['procesarAjax'])) {
            $this->procesarAjax();
        } elseif (isset($_REQUEST ["opcion"])) {

            switch ($_REQUEST ['opcion']) {

                case "ModificarContrato" :
                    $this->modificar();
                    break;
                case 'aprobarContratoFuncion' :

                    $this->aprobarContrato();
                    break;
                case 'procesarModificarElementos' :
                    $this->modificarElementos();
                    break;
                case 'modificarServicio' :
                    $this->modificarServicio();
                    break;
                case 'eliminarServicio' :
                    $this->eliminarServicio();
                    break;

                case 'eliminarElementoOrden' :
                    $this->eliminarElementoOrden();
                    break;
                case 'generarDocumento' :
                    $this->generarDocumento();
                    break;
            }
        }
    }

    function __construct() {
        $this->miConfigurador = \Configurador::singleton();

        $this->miInspectorHTML = \InspectorHTML::singleton();

        $this->ruta = $this->miConfigurador->getVariableConfiguracion("rutaBloque");

        $this->miMensaje = \Mensaje::singleton();

        $conexion = "aplicativo";
        $this->miRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        if (!$this->miRecursoDB) {

            $this->miConfigurador->fabricaConexiones->setRecursoDB($conexion, "tabla");
            $this->miRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        }
    }

    public function setRuta($unaRuta) {
        $this->ruta = $unaRuta;
    }

    function setSql($a) {
        $this->sql = $a;
    }

    function setFuncion($funcion) {
        $this->funcion = $funcion;
    }

    public function setLenguaje($lenguaje) {
        $this->lenguaje = $lenguaje;
    }

    public function setFormulario($formulario) {
        $this->formulario = $formulario;
    }

}

?>
