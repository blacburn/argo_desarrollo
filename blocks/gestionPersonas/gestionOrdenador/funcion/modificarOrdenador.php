<?php

namespace gestionPersonas\gestionOrdenador\funcion;

use gestionPersonas\gestionOrdenador\funcion\redireccion;

include_once ('redireccionar.php');

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class ModificadorSupervisor {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;
    var $miLogger;

    function __construct($lenguaje, $sql, $funcion, $miLogger) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
        $this->miLogger= $miLogger;
    }

    function cambiafecha_format($fecha) {
      ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
      $fechana = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
      return $fechana;
    }

    function procesarFormulario() {

      $conexionFrame = "estructura";
      $frameRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrame);
      $conexion = "contractual";
      $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
      $conexionAgora = "agora";
      $esteRecursoDBAgora = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionAgora);

      $SQLs = [];

      if(isset($_REQUEST['fecha_inicio_mod'])){$fechaInicio = $this->cambiafecha_format($_REQUEST['fecha_inicio_mod']);}else{$fechaInicio = NULL;}
      if(isset($_REQUEST['fecha_fin_mod'])){$fechaFin = $this->cambiafecha_format($_REQUEST['fecha_fin_mod']);}else{ $fechaFin = NULL;}

      $arregloDatos = array(
          'id_ordenador' => $_REQUEST['id_ordenador_hidden'],
          'nombre' => $_REQUEST['nombre_ordenador'],
          'documento' => $_REQUEST['documento_ordenador'],
          'digito' => $_REQUEST['digito_ordenador'],
          'rol_id' => $_REQUEST['rol_hidden'],
          'ciudadExp' => $_REQUEST['ciudad'],
          'fecha_inicio' => $fechaInicio,
          'fecha_fin' => $fechaFin,
          'resolucion' => html_entity_decode($_REQUEST['resolucion']),
          'estado' => 'TRUE',
          'id' => $_REQUEST['id_hidden']
      );

      $ordenadorCont['sql'] = $this->miSql->getCadenaSql ( 'actualizarOrdenadorApp', $arregloDatos );
      $ordenadorCont['descripcion'] = 'actualizarOrdenadorApp';
      $ordenadorCont['valores'] = $arregloDatos;
      array_push($SQLs, $ordenadorCont);

      $modificaOrdenadorCont = $esteRecursoDB->transaccion($SQLs);

    if($modificaOrdenadorCont){
            
            /*

            $conexion="framework";
            $frameworkRecursoDB=$this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
            $this->cadena_sql = $this->miSql->getCadenaSql("insertarUsuario", $arregloDatos);
            $resultadoEstado = $frameworkRecursoDB->ejecutarAcceso($this->cadena_sql, "acceso");

                
            $parametro['id_usuario']=$arregloDatos['id_usuario'];
            $cadena_sql = $this->miSql->getCadenaSql("consultarPerfilUsuario", $parametro);
            $resultadoPerfil = $frameworkRecursoDB->ejecutarAcceso($cadena_sql, "busqueda");
            
            $log=array('accion'=>"REGISTRO",
                        'id_registro'=>$_REQUEST['tipo_identificacion'].$_REQUEST['identificacion'],
                        'tipo_registro'=>"GESTION USUARIO",
                        'nombre_registro'=>"id_usuario=>".$_REQUEST['tipo_identificacion'].$_REQUEST['identificacion'].
                                           "|identificacion=>".$_REQUEST['identificacion'].
                                           "|tipo_identificacion=>".$_REQUEST['tipo_identificacion'].
                                           "|nombres=>".$_REQUEST['nombres'].
                                           "|apellidos=>".$_REQUEST['apellidos'].
                                           "|correo=>".$_REQUEST['correo'].
                                           "|telefono=>".$_REQUEST['telefono'].
                                           "|subsistema=>".$_REQUEST['subsistema'].
                                           "|perfil=>".$_REQUEST['perfil'].
                                           "|fechaIni=>".$hoy.
                                           "|fechaFin=>".$_REQUEST['fechaFin'],
                        'descripcion'=>"Registro de nuevo Usuario ".$_REQUEST['tipo_identificacion'].$_REQUEST['identificacion']." con perfil ".$resultadoPerfil[0]['rol_alias'],
                       ); 
            $this->miLogger->log_usuario($log);
            */

            redireccion::redireccionar('modifico',$arregloDatos);  
            exit();
        }else{       
            redireccion::redireccionar('noModifico',$arregloDatos);  
            exit();
        }
  
    }

    function resetForm() {
        foreach ($_REQUEST as $clave => $valor) {

            if ($clave != 'pagina' && $clave != 'development' && $clave != 'jquery' && $clave != 'tiempo') {
                unset($_REQUEST [$clave]);
            }
        }
    }

}

$miModificador = new ModificadorSupervisor($this->lenguaje, $this->sql, $this->funcion, $this->miLogger);

$resultado = $miModificador->procesarFormulario();
?>