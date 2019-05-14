<?php

namespace gestionCompras\registrarOrden\funcion;

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
                $variable .= "&mensaje=confirma";
                $variable .= "&mensaje_titulo=" . $valor ['mensaje'];
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                break;

            case "noInserto" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=error";
                if(isset($valor ['caso'])){
                    $variable .= "&caso=" . $valor ['caso'];
                }

                break;
            case "ErrorRegistroSociedadTemporal" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=ErrorRegistroSociedadTemporal";
                $variable .= "&usuario=" . $_REQUEST ['usuario'];
                break;



            case "notextos" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=otros";
                $variable .= "&errores=notextos";

                break;

            case "paginaPrincipal" :
                $variable = "pagina=" . $miPaginaActual;
                break;

            case "RegistrarElementos" :

                $variable = "pagina=registrarElementoOrden";
                $variable .= "&opcion=cargarElemento";
                $variable .= "&id_orden=" . $valor [0];
                $variable .= "&mensaje_titulo=" . $valor [1];
                $variable .= "&registroOrden=true";

                break;

            case "ConsultarOrdenes" :

                $variable = "pagina=ConsultaOrden";
                $variable.="&opcion=mostrar";

                break;
	   case "ErrorRegistroContratoDuplicado" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noInsertoContratoDuplicado";
                $variable .= "&contrato=" . $valor ['contrato'];
                $variable .= "&contratista=" . $valor ['contratista'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
            

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
