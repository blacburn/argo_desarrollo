<?php

namespace gestionActas\gestionActasInicio\funcion;

if (!isset($GLOBALS ["autorizado"])) {
    include ("index.php");
    exit();
}

class redireccion {

    public static function redireccionar($opcion, $valor = "") {
        $miConfigurador = \Configurador::singleton();
        $miPaginaActual = $miConfigurador->getVariableConfiguracion("pagina");

        switch ($opcion) {


           case "registroActa" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=registroActa";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&usuario=" . $valor ['usuario'];
                if (isset ( $valor ['accesoCondor'] ) && $valor ['accesoCondor'] == 'true') {
						
					$variable .= "&accesoCondor=true";
         	}
			
                break;

            case "noRegistroActa" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noRegistroActa";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&usuario=" . $valor ['usuario'];
                if (isset ( $valor ['accesoCondor'] ) && $valor ['accesoCondor'] == 'true') {
						
					$variable .= "&accesoCondor=true";
		}
			
                break;
            
            case "modificoActa" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=modificoActa";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&usuario=" . $valor ['usuario'];
                if (isset ( $valor ['accesoCondor'] ) && $valor ['accesoCondor'] == 'true') {
						
					$variable .= "&accesoCondor=true";
		}
			
                break;

            case "noModificoActa" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noModificoActa";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&usuario=" . $valor ['usuario'];
                if (isset ( $valor ['accesoCondor'] ) && $valor ['accesoCondor'] == 'true') {
						
					$variable .= "&accesoCondor=true";
		}
			
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