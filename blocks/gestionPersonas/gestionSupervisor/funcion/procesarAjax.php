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

?>
