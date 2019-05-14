<?php

namespace gestionPersonas\gestionSupervisor\funcion;

if (!isset($GLOBALS ["autorizado"])) {
    include ("index.php");
    exit();
}

class redireccion {

    public static function redireccionar($opcion, $valor = "") {
        $miConfigurador = \Configurador::singleton();
        $miPaginaActual = $miConfigurador->getVariableConfiguracion("pagina");

        switch ($opcion) {


            case "inserto" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=registroSupervisor";
                $variable .= "&nombre=" . $valor ['nombre'];
                $variable .= "&documento=" . $valor ['documento'];
                $variable .= "&digito=" . $valor ['digito'];
                $variable .= "&cargo=" . $valor ['cargo'];
                $variable .= "&sede=" . $valor ['sede'];
                $variable .= "&dependencia=" . $valor ['dependencia'];
                $variable .= "&fecha_inicio=" . $valor ['fecha_inicio'];
                $variable .= "&fecha_fin=" . $valor ['fecha_fin'];
                break;

            case "noInserto" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noRegistroSupervisor";
                $variable .= "&nombre=" . $valor ['nombre'];
                $variable .= "&documento=" . $valor ['documento'];
                $variable .= "&digito=" . $valor ['digito'];
                $variable .= "&cargo=" . $valor ['cargo'];
                $variable .= "&sede=" . $valor ['sede'];
                $variable .= "&dependencia=" . $valor ['dependencia'];
                $variable .= "&fecha_inicio=" . $valor ['fecha_inicio'];
                $variable .= "&fecha_fin=" . $valor ['fecha_fin'];
                break;

            case "modifico" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=modificoSupervisor";
                $variable .= "&nombre=" . $valor ['nombre'];
                $variable .= "&documento=" . $valor ['documento'];
                $variable .= "&digito=" . $valor ['digito'];
                $variable .= "&cargo_id=" . $valor ['cargo_id'];
                $variable .= "&sede=" . $valor ['sede'];
                $variable .= "&dependencia=" . $valor ['dependencia'];
                $variable .= "&fecha_inicio=" . $valor ['fecha_inicio'];
                $variable .= "&fecha_fin=" . $valor ['fecha_fin'];
                break;

            case "noModifico" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noModificoSupervisor";
                $variable .= "&nombre=" . $valor ['nombre'];
                $variable .= "&documento=" . $valor ['documento'];
                $variable .= "&digito=" . $valor ['digito'];
                $variable .= "&cargo_id=" . $valor ['cargo_id'];
                $variable .= "&sede=" . $valor ['sede'];
                $variable .= "&dependencia=" . $valor ['dependencia'];
                $variable .= "&fecha_inicio=" . $valor ['fecha_inicio'];
                $variable .= "&fecha_fin=" . $valor ['fecha_fin'];
                break;

            case "regresar" :
                $variable = "pagina=" . $miPaginaActual;
                break;

            case "paginaPrincipal" :
                $variable = "pagina=" . $miPaginaActual;
                break;
        }

        foreach ($_REQUEST as $clave => $valor) {
            unset($_REQUEST [$clave]);
        }

        $url = $miConfigurador->configuracion ["host"] . $miConfigurador->configuracion ["site"] . "/index.php?";
        $enlace = $miConfigurador->configuracion ['enlace'];
        $variable = $miConfigurador->fabricaConexiones->crypto->codificar($variable);
        $_REQUEST [$enlace] = $enlace . '=' . $variable;
        $redireccion = $url . $_REQUEST [$enlace];

        echo "<script>location.replace('" . $redireccion . "')</script>";
    }

}

?>