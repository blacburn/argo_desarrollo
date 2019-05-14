<?php

namespace gestionPersonas\gestionOrdenador;

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

include_once ("core/manager/Configurador.class.php");

class Frontera {

    var $ruta;
    var $sql;
    var $funcion;
    var $lenguaje;
    var $formulario;
    var $miConfigurador;

    function __construct() {
        $this->miConfigurador = \Configurador::singleton();
    }

    public function setRuta($unaRuta) {
        $this->ruta = $unaRuta;
    }

    public function setLenguaje($lenguaje) {
        $this->lenguaje = $lenguaje;
    }

    public function setFormulario($formulario) {
        $this->formulario = $formulario;
    }

    function frontera() {
        $this->html();
    }

    function setSql($a) {
        $this->sql = $a;
    }

    function setFuncion($funcion) {
        $this->funcion = $funcion;
    }

    function html() {

        include_once ("core/builder/FormularioHtml.class.php");

        $this->ruta = $this->miConfigurador->getVariableConfiguracion("rutaBloque");

        $this->miFormulario = new \FormularioHtml ();

        if (isset($_REQUEST ['opcion'])) {

            switch ($_REQUEST ['opcion']) {

                case "mensaje" :
                    include_once ($this->ruta . "/formulario/mensaje.php");
                    break;

                case "ConsultarSupervisores" :
                    include_once ($this->ruta . "/formulario/resultado.php");
                    break;
                        
                case "registrarSupervisor" :
                    include_once ($this->ruta . "/formulario/registroSupervisor.php");
                    break;

                case "registrarOrdenador" :
                    include_once ($this->ruta . "/formulario/registroOrdenador.php");
                    break;    

                case "gestionarSupervisor" :
                    include_once ($this->ruta . "/formulario/gestionSupervisor.php");
                    break;

                case "gestionarOrdenador" :
                    include_once ($this->ruta . "/formulario/gestionOrdenador.php");
                    break;          

                case "cancelar" :
                    include_once ($this->ruta . "/formulario/cancelarContrato.php");
                    break;
            }
        } else {
            $_REQUEST ['opcion'] = "mostrar";
            include_once ($this->ruta . "/formulario/resultado.php");
        }
    }

}

?>
