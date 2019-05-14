<?php

$conexion = "contractual";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

$conexionFrameWork = "estructura";
$DBFrameWork = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrameWork);

$conexionAgora = "agora";
$esteRecursoDBAgora = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionAgora);

$conexionSICA = "sicapital";
$DBSICA = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionSICA);


//------------------------obtener Dependencias de acuerdo al identificador de la sede -------------------------
if ($_REQUEST ['funcion'] == 'consultarDependencia') {

    $cadenaSql = $this->sql->getCadenaSql('dependenciasConsultadas', $_REQUEST ['valor']);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultado);
    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarComCargo') {
    
    $datos = array (
            'cargo' => $_REQUEST['cargo'],
            'sede' => $_REQUEST['sede'],
            'dependencia' => $_REQUEST['dependencia']
    );
    $cadenaSql = $this->sql->getCadenaSql('consultaSupervisoresCom', $datos);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultado);
    echo $resultado;
}


if ($_REQUEST ['funcion'] == 'consultarComRol') {
    
    $datos = array (
            'rol' => $_REQUEST['rol']
    );
    $cadenaSql = $this->sql->getCadenaSql('consultaOrdenadoresCom', $datos);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultado);
    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarDepartamentoAjax') {
    $cadenaSql = $this->sql->getCadenaSql ( 'buscarDepartamentoAjax', $_REQUEST['valor'] );
    $resultado = $esteRecursoDBAgora->ejecutarAcceso ( $cadenaSql, "busqueda" );
    $resultado = json_encode ( $resultado);
    echo $resultado;
}
if ($_REQUEST ['funcion'] == 'consultarCiudadAjax') {
    $cadenaSql = $this->sql->getCadenaSql ( 'buscarCiudadAjax', $_REQUEST['valor'] );
    $resultado = $esteRecursoDBAgora->ejecutarAcceso ( $cadenaSql, "busqueda" );
    $resultado = json_encode ( $resultado);
    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarPaisAjax') {
    $cadenaSql = $this->sql->getCadenaSql ( 'buscarPaisCod', $_REQUEST['valor'] );
    $resultado = $esteRecursoDBAgora->ejecutarAcceso ( $cadenaSql, "busqueda" );
    $resultado = json_encode ( $resultado);
    echo $resultado;
}

?>
