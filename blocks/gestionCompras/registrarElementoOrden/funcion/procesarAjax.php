<?php

$conexion = "contractual";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
$conexionAgora = "agora";
$esteRecursoDBAgora = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionAgora);

$conexion = "inventarios";
$esteRecursoDBArka = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

$conexionFrameWork = "estructura";
$DBFrameWork = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrameWork);

$conexionSICA = "sicapital";
$DBSICA = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionSICA);

$ruta_1 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel.class.php';
$ruta_2 = $this->miConfigurador->getVariableConfiguracion('raizDocumento') . '/plugin/php_excel/Classes/PHPExcel/Reader/Excel2007.class.php';

include_once ($ruta_1);
include_once ($ruta_2);


//-----Consulta Contratos ---------------------------------

if ($_REQUEST ['funcion'] == 'consultaContrato') {

    $id_usuario = $_REQUEST['usuario'];
    $cadenaSqlUnidad = $this->sql->getCadenaSql("obtenerInfoUsuario", $id_usuario);
    $unidadEjecutora = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");
    $cadenaSql = $this->sql->getCadenaSql('buscar_contrato', array('parametro' => $_GET ['query'], 'unidad' => $unidadEjecutora[0]['unidad_ejecutora']
        , 'vigencia_curso' => date("Y")));

    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    foreach ($resultadoItems as $key => $values) {
        $keys = array(
            'value',
            'data'
        );
        $resultado [$key] = array_intersect_key($resultadoItems [$key], array_flip($keys));
    }

    echo '{"suggestions":' . json_encode($resultado) . '}';
}

if ($_REQUEST ['funcion'] == 'consultarValorIva') {

    $cadenaSql = $this->sql->getCadenaSql('consultar_tipo_valor_iva',$_REQUEST['valor']);
  

    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


    $resultado = json_encode($resultado);

    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultaContratista') {

    $cadenaSql = $this->sql->getCadenaSql('buscar_contratista', $_GET ['query']);

    $resultadoItems = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");

    foreach ($resultadoItems as $key => $values) {
        $keys = array(
            'value',
            'data'
        );
        $resultado [$key] = array_intersect_key($resultadoItems [$key], array_flip($keys));
    }

    echo '{"suggestions":' . json_encode($resultado) . '}';
}
//---------------------------------------------------------

if ($_REQUEST ['funcion'] == 'SeleccionTipoBien') {

    $cadenaSql = $this->sql->getCadenaSql('ConsultaTipoBien', $_REQUEST ['valor']);
    $resultadoItems = $esteRecursoDBArka->ejecutarAcceso($cadenaSql, "busqueda");
    $resultadoItems = $resultadoItems [0];

    echo json_encode($resultadoItems);
}

if ($_REQUEST ['funcion'] == 'consultarIva') {

    $cadenaSql = $this->sql->getCadenaSql('consultar_tipo_iva');

    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

    $resultado = json_encode($resultado);

    echo $resultado;
}
if ($_REQUEST ['funcion'] == 'consultarDependencias') {

    $cadenaSql = $this->sql->getCadenaSql('dependenciasConsultadas', $_REQUEST ['valor']);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultado);
    echo $resultado;
}
if ($_REQUEST ['funcion'] == 'consultarDependencia') {

    $cadenaSql = $this->sql->getCadenaSql('dependenciasConsultadas', $_REQUEST ['valor']);
    $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultado);

    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultaProveedor') {

    $cadenaSql = $this->sql->getCadenaSql('buscar_Proveedores', $_GET ['query']);

    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

    foreach ($resultadoItems as $key => $values) {
        $keys = array(
            'value',
            'data'
        );
        $resultado [$key] = array_intersect_key($resultadoItems [$key], array_flip($keys));
    }

    echo '{"suggestions":' . json_encode($resultado) . '}';
}


if ($_REQUEST ['funcion'] == 'consultarInfoConvenio') {

    $cadenaSql = $this->sql->getCadenaSql('informacion_convenio', $_REQUEST['codigo']);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

    $resultado = json_encode($resultadoItems [0]);

    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarProveedorFiltro') {

    $cadenaSql = $this->sql->getCadenaSql('buscarProveedoresFiltro', $_GET ['query']);
    $resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    foreach ($resultadoItems as $key => $values) {
        $keys = array(
            'value',
            'data'
        );
        $resultado [$key] = array_intersect_key($resultadoItems [$key], array_flip($keys));
    }

    echo '{"suggestions":' . json_encode($resultado) . '}';
}
if ($_REQUEST ['funcion'] == 'consultarInfoContratistaUnico') {

    $cadenaSql = $this->sql->getCadenaSql('informacion_contratista_unico', $_REQUEST['id']);
    $resultadoItems = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");
    $resultado = json_encode($resultadoItems [0]);

    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarInfoSociedadTemporal') {

    $cadenaSql = $this->sql->getCadenaSql('informacion_sociedad_temporal_consulta', $_REQUEST['id']);
    $resultadoItems = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");
    $sqlParticipantes = $this->sql->getCadenaSql("obtener_participantes", $_REQUEST['id']);
    $participantes = $esteRecursoDBAgora->ejecutarAcceso($sqlParticipantes, "busqueda");
    array_push($resultadoItems, $participantes);
    $resultado = json_encode($resultadoItems);
    echo $resultado;
}

if ($_REQUEST ['funcion'] == 'verificarArchivo') {


    $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");
    // ** Ruta a directorio ******
    $rutaBloque = $this->miConfigurador->getVariableConfiguracion("raizDocumento") . "/blocks/gestionCompras/";
    $rutaBloque .= $esteBloque ['nombre'];
    $host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/gestionCompras/" . $esteBloque ['nombre'];


    $tipo_validacion = '';
    $ingreso = 0;

    $ruta_eliminar_xlsx = $rutaBloque . "/archivo/*.xlsx";

    $ruta_eliminar_xls = $rutaBloque . "/archivo/*.xls";

    foreach (glob($ruta_eliminar_xlsx) as $filename) {
        unlink($filename);
    }
    foreach (glob($ruta_eliminar_xls) as $filename) {
        unlink($filename);
    }

    foreach ($_FILES as $key => $values) {
        $archivo [] = $_FILES [$key];
    }

    $archivo = $archivo [0];

    $trozos = explode(".", $archivo ['name']);
    $extension = end($trozos);
    if ($extension == 'xlsx') {
        if ($archivo) {
            // obtenemos los datos del archivo
            $tamano = $archivo ['size'];
            $tipo = $archivo ['type'];
            $archivo1 = $archivo ['name'];
            $prefijo = "archivo";

            if ($archivo1 != "") {
                // guardamos el archivo a la carpeta files
                $ruta_absoluta = $rutaBloque . "/archivo/" . $archivo1;
                // echo $ruta_absoluta;exit;

                if (copy($archivo ['tmp_name'], $ruta_absoluta)) {
                    $status = "Archivo subido: <b>" . $archivo1 . "</b>";
                } else {
                    $tipo_validacion = 'error copia del archivo en el servidor';
                    exit();
                }
            } else {
                $tipo_validacion = 'error nombre del archivo';
                exit();
            }
        }
        if (file_exists($ruta_absoluta)) {
            $objReader = new \PHPExcel_Reader_Excel2007 ();
            $objPHPExcel = $objReader->load($ruta_absoluta);
            $objFecha = new \PHPExcel_Shared_Date ();

            // Asignar hoja de excel activa

            $objPHPExcel->setActiveSheetIndex(0);
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            $highestRow = $objWorksheet->getHighestRow();

            $arregloValidacion = 0;
            $arregloServicioValidacion = 0;

            if ($highestRow > 1) {


                $arregloValidacion = 1;


                for ($i = 2; $i <= $highestRow; $i++) {

                    $datos [$i] ['Tipo'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                    
                    if (is_null($datos [$i] ['Tipo']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna A - Fila ' . $i .'  Pestaña Elemento ';
                        echo json_encode($tipo_validacion);
                        exit();
                    }

                    $datos [$i] ['Nombre'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Nombre']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna B - Fila  ' . $i .'  Pestaña Elemento ';
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Descripcion'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Descripcion']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna C - Fila  ' . $i .'  Pestaña Elemento ';
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Cantidad'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Cantidad']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna D - Fila  ' . $i .'  Pestaña Elemento ';
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Unidad'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Unidad']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna E - Fila  ' . $i .'  Pestaña Elemento ';
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Valor'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Valor']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna F - Fila  ' . $i .'  Pestaña Elemento ';
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Iva'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Iva']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna G - Fila  ' . $i .'  Pestaña Elemento ';
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Dependencia'] = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
                    
                  
                    
                    
                    if($datos [$i] ['Dependencia']){
                         $cadenaSql = $this->sql->getCadenaSql('buscar_dependencia', $datos [$i] ['Dependencia']);
                         $resultadoDependencia = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                         
                         $datos [$i] ['Dependencia'] = trim($resultadoDependencia [0][1], "'");
                         
                         if($resultadoDependencia === false){
                              $tipo_validacion = ' Datos erroneos en Columna H - Fila ' . $i .'  Pestaña Elemento ';
                               echo json_encode($tipo_validacion);
                                exit();                        

                         }
                    }
                    else{
                        $datos [$i] ['Dependencia']='';
                    }
                    

                    $datos [$i] ['Funcionario'] = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
                    
                    if($datos [$i] ['Funcionario']){
                         $cadenaSql = $this->sql->getCadenaSql('buscar_funcionario', $datos [$i] ['Funcionario']);
                         $resultadoFuncionario = $DBSICA->ejecutarAcceso($cadenaSql, "busqueda");
                         
                         $datos [$i] ['Funcionario']=trim($resultadoFuncionario[0][1], "'");
        
                         if($resultadoFuncionario === false){
                              $tipo_validacion = ' Datos erroneos en Columna I -  Fila ' . $i .'  Pestaña Elemento ';
                               echo json_encode($tipo_validacion);
                                exit();                        

                         }
                    }
                     else{
                        $datos [$i] ['Funcionario']='';
                    }
                }



                for ($i = 2; $i <= $highestRow; $i++) {

                    $arreglo[] = array(
                        'tipo' => trim($datos [$i] ['Tipo'], "'"),
                        'nombre' => trim($datos [$i] ['Nombre'], "'"),
                        'descripcion' => trim($datos [$i] ['Descripcion'], "'"),
                        'tiempo_ejecucion' => '',
                        'cantidad' => $datos [$i] ['Cantidad'],
                        'unidad' => trim($datos [$i] ['Unidad'], "'"),
                        'valor' => $datos [$i] ['Valor'],
                        'iva' => trim($datos [$i] ['Iva'], "'"),
                        'dependencia' => $datos [$i] ['Dependencia'],
                        'funcionario' => $datos [$i] ['Funcionario'],
                    );
                }
            }

            $objPHPExcel->setActiveSheetIndex(1);
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(1);
            $highestRow = $objWorksheet->getHighestRow(0);

            if ($highestRow > 1) {


                $arregloServicioValidacion = 1;

                for ($i = 2; $i <= $highestRow; $i++) {

                    $datos [$i] ['Tipo'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Tipo']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna A - Fila' . $i .'  Pestaña Servicio ' ;
                        echo json_encode($tipo_validacion);
                        exit();
                    }

                    $datos [$i] ['Nombre'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Nombre']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna B - Fila ' . $i .'  Pestaña Servicio ' ;
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Descripcion'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Descripcion']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna C - Fila ' . $i .'  Pestaña Servicio ' ;
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Cantidad'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Cantidad']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna D - Fila ' . $i .'  Pestaña Servicio ' ;
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Unidad'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Unidad']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna E - Fila ' . $i .'  Pestaña Servicio ' ;
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Valor'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Valor']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna F - Fila ' . $i .'  Pestaña Servicio ' ;
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Iva'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Iva']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna G - Fila ' . $i .'  Pestaña Servicio ' ;
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                    $datos [$i] ['Dependencia'] = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
                    
                    if($datos [$i] ['Dependencia']){
                        
                        
                         $cadenaSql = $this->sql->getCadenaSql('buscar_dependencia', $datos [$i] ['Dependencia']);
                         $resultadoDependencia = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
                         
                         $datos [$i] ['Dependencia'] = trim($resultadoDependencia [0][1], "'");
                         
                         if($resultadoDependencia === false){
                              $tipo_validacion = ' Datos erroneos en Columna H - Fila ' . $i .'  Pestaña Servicio ';
                               echo json_encode($tipo_validacion);
                                exit();                        

                         }
                        
                    }
                  else{
                        $datos [$i] ['Dependencia']='';
                    }

                    $datos [$i] ['Funcionario'] = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
                    
                    if($datos [$i] ['Funcionario']){
                         $cadenaSql = $this->sql->getCadenaSql('buscar_funcionario', $datos [$i] ['Funcionario']);
                         $resultadoFuncionario = $DBSICA->ejecutarAcceso($cadenaSql, "busqueda");
                         
                         $datos [$i] ['Funcionario']=trim($resultadoFuncionario[0][1], "'");
                         
                         if($resultadoFuncionario === false){
                              $tipo_validacion = ' Datos erroneos en Columna I - Fila ' . $i .'  Pestaña Servicio ';
                               echo json_encode($tipo_validacion);
                                exit();                        

                         }
                    }
                    else{
                        $datos [$i] ['Funcionario']='';
                    }
                    
                     $datos [$i] ['Unidad_Ejecucion'] = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
                    if (is_null($datos [$i] ['Unidad_Ejecucion']) == true) {

                        $tipo_validacion = ' Datos vacios en Columna J - Fila Pestaña Servicio ' . $i;
                        echo json_encode($tipo_validacion);
                        exit();
                    }
                }


                for ($i = 2; $i <= $highestRow; $i++) {

                    $arregloServicio[] = array(
                        'tipo' => trim($datos [$i] ['Tipo'], "'"),
                        'nombre' => trim($datos [$i] ['Nombre'], "'"),
                        'descripcion' => trim($datos [$i] ['Descripcion'], "'"),
                        'tiempo_ejecucion' => $datos [$i] ['Unidad_Ejecucion'],
                        'cantidad' => $datos [$i] ['Cantidad'],
                        'unidad' => trim($datos [$i] ['Unidad'], "'"),
                        'valor' => $datos [$i] ['Valor'],
                        'iva' => trim($datos [$i] ['Iva'], "'"),
                        'dependencia' =>$datos [$i] ['Dependencia'],
                        'funcionario' => $datos [$i] ['Funcionario'],
                    );
                }
            }

            if ($arregloValidacion == 1 && $arregloServicioValidacion == 1) {
                $arregloDefinitivo = array_merge($arreglo, $arregloServicio);
            } else {
                if ($arregloValidacion == 1) {
                    $arregloDefinitivo = $arreglo;
                } else {
                    if ($arregloServicioValidacion == 1) {
                        $arregloDefinitivo = $arregloServicio;
                    } else {
                        $arregloDefinitivo = null;
                    }
                }
            }



            foreach (glob($ruta_eliminar_xlsx) as $filename) {
                unlink($filename);
            }
            foreach (glob($ruta_eliminar_xls) as $filename) {
                unlink($filename);
            }
        }
    } else {
        $tipo_validacion = 'error extension del archivo debe ser xlsx';
    }
//		
//                $cadenaSql = $this->sql->getCadenaSql ( 'tipoNecesidadAdministrativaOnlyBien');
//		$datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

    if ($tipo_validacion != '') {
        $arreglo = $tipo_validacion;
    }

    echo json_encode($arregloDefinitivo);
}
?>