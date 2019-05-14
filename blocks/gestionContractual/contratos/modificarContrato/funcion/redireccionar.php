<?php

namespace contratos\modificarContrato\funcion;

if (!isset($GLOBALS ["autorizado"])) {
    include ("index.php");
    exit();
}

class redireccion {

    public static function redireccionar($opcion, $valor = "", $valor1 = "") {
        $miConfigurador = \Configurador::singleton();
        $miPaginaActual = $miConfigurador->getVariableConfiguracion("pagina");



        switch ($opcion) {
            case "Actualizo" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=Actualizo";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&usuario=" . $_REQUEST ['usuario'];
                if(isset($valor ['miPaginaAct'])){
                    $variable .= "&miPaginaAct=" . $valor ['miPaginaAct'];
                    $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                }

                break;

            case "ActualizoServicio" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=ActualizoServicio";
                $variable .= "&id_servicio=" . $valor['id_servicio'];
                break;
            case "noActualizoServicio" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noActualizoServicio";

                break;
            case "eliminoServicio" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=eliminoServicio";

                break;
            case "noeliminoServicio" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noeliminoServicio";

                break;
            case "novedaddeModificacion" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=novedaddeModificacion";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&idnovedadModificacion=" . $valor ['idnovedadModificacion'];
                $variable .= "&usuario=" . $_REQUEST ['usuario'];

                break;
            case "NoActualizo" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=NoActualizo";
                $variable .= "&numero_contrato=" . $valor ['numero_contrato'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&usuario=" . $_REQUEST ['usuario'];
                if(isset($valor ['miPaginaAct'])){
                    $variable .= "&miPaginaAct=" . $valor ['miPaginaAct'];
                    $variable .= "&numero_contrato_suscrito=" . $valor ['numero_contrato_suscrito'];
                }
                if(isset($valor ['caso'])){
                    $variable .= "&caso=" . $valor ['caso'];
                }

                break;

            case "ErrorRegistro" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noInserto";
                $variable .= "&usuario=" . $_REQUEST ['usuario'];
                break;

            case "ErrorRegistroSociedadTemporal" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=ErrorRegistroSociedadTemporal";
                $variable .= "&usuario=" . $_REQUEST ['usuario'];
                break;


            case "Salir" :

                $variable = "pagina=indexAlmacen";

                break;

            case "SalidaElemento" :

                $variable = "pagina=registrarSalidas";
                $variable .= "&opcion=Salida";
                $variable .= "&numero_entrada=" . $valor;
                $variable .= "&datosGenerales=" . $valor1;
                break;

            case "aproboContrato" :

                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=aproboContrato";
                $variable .= "&numero_contrato=" . $valor['numero_contrato'];
                $variable .= "&vigencia=" . $valor['vigencia'];
                $variable .= "&fecha_aprobacion=" . $valor['fecha_suscripcion'];
                $variable .= "&usuario=" . $valor['usuario'];
                $variable .= "&numero_contrato_suscrito=" . $valor['numero_contrato_suscrito'];

                break;

            case "noAproboContrato" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noAproboContrato";
                $variable .= "&numero_contrato=" . $valor['numero_contrato'];
                $variable .= "&vigencia=" . $valor['vigencia'];


                break;
            case "aproboContratos" :

                $datos = serialize($valor);
                $datos = urlencode($datos);
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=aproboContratos";
                $variable .= "&datos=" . $datos;
                break;

            case "noAproboContratos" :
                $datos = serialize($valor);
                $datos = urlencode($datos);
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noAproboContratos";
                $variable .= "&datos=" . $datos;

                break;

//            case "ActualizoElemento" :
//                $variable = "pagina=" . $miPaginaActual;
//                $variable .= "&opcion=mensaje";
//                $variable .= "&mensaje=ActualizoElemento";
//                $variable .= "&id_orden=" . $valor[0];
//                $variable .= "&mensaje_titulo=" . $valor[1];
//                $variable .= "&arreglo=" . $valor[2];
//                $variable .= "&id_elemento_acta=" . $valor[3];
//
//                break;
            
            
             case "modificoElementos" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=ActualizoElemento";
                $variable .= "&id_elemento_acta=" . $valor ['id_elemento_acta'];
                $variable .= "&numerocontrato=" . $valor ['numerocontrato'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&arreglo=" . stripslashes($valor ['arreglo']);
                $variable .= "&mensaje_titulo=" . $valor ['mensaje_titulo'];

                break;


            case "noActualizoElemento" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noActualizoElemento";

                break;

            
            
              case "eliminoElemento" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&id_elemento_acta=" . $valor ['id_elemento_acta'];
                $variable .= "&numerocontrato=" . $valor ['numerocontrato'];
                $variable .= "&vigencia=" . $valor ['vigencia'];
                $variable .= "&arreglo=" . stripslashes($valor ['arreglo']);
                $variable .= "&mensaje_titulo=" . $valor ['mensaje_titulo'];
                $variable .= "&mensaje=eliminoElemento";

                break;

            case "noeliminoElemento" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noeliminoElemento";

                break;
            case "ErrorRegistroContratoExiste" :
                $variable = "pagina=" . $miPaginaActual;
                $variable .= "&bloque=" . $_REQUEST ['bloque'];
                $variable .= "&bloqueGrupo=" . $_REQUEST ["bloqueGrupo"];
                $variable .= "&opcion=mensaje";
                $variable .= "&mensaje=noInsertoContratoExiste";
                $variable .= "&contratista=" . $valor ['contratista'];
                $variable .= "&fecha_fin=" . $valor ['fin_contrato_actual'];

                break;
            
//            case "modificoElementos" :
//				
//				$variable = "pagina=" . $miPaginaActual;
//				$variable .= "&opcion=mensaje";
//				$variable .= "&mensaje=modificoElemento";
//				$variable .= "&mensaje_titulo=" . $valor [0];
//				$variable .= "&id_orden=" . $valor [1];
//				$variable .= "&fecha_orden=" . $valor [2];
//				$variable .= "&numero_contrato=" . $valor [5];
//				$variable .= "&vigencia=" . $valor [6];
//				if ($valor [3] == '\'true\'') {
//					$variable .= "&registroOrden=true";
//				} else {
//					
//					$variable .= "&arreglo=" . $valor [3];
//				}
//				$variable .= "&usuario=" . $valor [4];
//				
//	    break;
            
             case "noModificoElementos" :
				
			$variable = "pagina=" . $miPaginaActual;
				$variable .= "&opcion=mensaje";
				$variable .= "&mensaje=noModificoElemento";
				$variable .= "&mensaje_titulo=" . $valor [0];
				$variable .= "&id_orden=" . $valor [1];
                                $variable .= "&numero_contrato=" . $valor [5];
				$variable .= "&vigencia=" . $valor [6];

				if ($valor [3] == '') {
					$variable .= "&registroOrden=true";
				} else {
						
					$variable .= "&arreglo=" . $valor [3];
				}
				
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