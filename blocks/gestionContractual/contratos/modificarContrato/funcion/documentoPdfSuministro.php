<?php

$ruta = $this->miConfigurador->getVariableConfiguracion("raizDocumento");

$host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/plugin/html2pfd/";

require_once ($ruta . "/plugin/mpdf/mpdf.php");

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class EnLetras {

    var $Void = "";
    var $SP = " ";
    var $Dot = ".";
    var $Zero = "0";
    var $Neg = "Menos";

    function ValorEnLetras($x, $Moneda) {
        $s = "";
        $Ent = "";
        $Frc = "";
        $Signo = "";

        if (floatVal($x) < 0)
            $Signo = $this->Neg . " ";
        else
            $Signo = "";

        if (intval(number_format($x, 2, '.', '')) != $x) // <- averiguar si tiene decimales
            $s = number_format($x, 2, '.', '');
        else
            $s = number_format($x, 0, '.', '');

        $Pto = strpos($s, $this->Dot);

        if ($Pto === false) {
            $Ent = $s;
            $Frc = $this->Void;
        } else {
            $Ent = substr($s, 0, $Pto);
            $Frc = substr($s, $Pto + 1);
        }

        if ($Ent == $this->Zero || $Ent == $this->Void)
            $s = "Cero ";
        elseif (strlen($Ent) > 7) {
            $s = $this->SubValLetra(intval(substr($Ent, 0, strlen($Ent) - 6))) . "Millones " . $this->SubValLetra(intval(substr($Ent, - 6, 6)));
        } else {
            $s = $this->SubValLetra(intval($Ent));
        }

        if (substr($s, - 9, 9) == "Millones " || substr($s, - 7, 7) == "Millón ")
            $s = $s . "de ";

        $s = $s . $Moneda;

        if ($Frc != $this->Void) {
            $s = $s . " Con " . $this->SubValLetra(intval($Frc)) . "Centavos";
            // $s = $s . " " . $Frc . "/100";
        }
        return ($Signo . $s . "");
    }

    function SubValLetra($numero) {
        $Ptr = "";
        $n = 0;
        $i = 0;
        $x = "";
        $Rtn = "";
        $Tem = "";

        $x = trim("$numero");
        $n = strlen($x);

        $Tem = $this->Void;
        $i = $n;

        while ($i > 0) {
            $Tem = $this->Parte(intval(substr($x, $n - $i, 1) . str_repeat($this->Zero, $i - 1)));
            If ($Tem != "Cero")
                $Rtn .= $Tem . $this->SP;
            $i = $i - 1;
        }

        // --------------------- GoSub FiltroMil ------------------------------
        $Rtn = str_replace(" Mil Mil", " Un Mil", $Rtn);
        while (1) {
            $Ptr = strpos($Rtn, "Mil ");
            If (!($Ptr === false)) {
                If (!(strpos($Rtn, "Mil ", $Ptr + 1) === false))
                    $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
                else
                    break;
            } else
                break;
        }

        // --------------------- GoSub FiltroCiento ------------------------------
        $Ptr = - 1;
        do {
            $Ptr = strpos($Rtn, "Cien ", $Ptr + 1);
            if (!($Ptr === false)) {
                $Tem = substr($Rtn, $Ptr + 5, 1);
                if ($Tem == "M" || $Tem == $this->Void)
                    ;
                else
                    $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
            }
        } while (!($Ptr === false));

        // --------------------- FiltroEspeciales ------------------------------
        $Rtn = str_replace("Diez Un", "Once", $Rtn);
        $Rtn = str_replace("Diez Dos", "Doce", $Rtn);
        $Rtn = str_replace("Diez Tres", "Trece", $Rtn);
        $Rtn = str_replace("Diez Cuatro", "Catorce", $Rtn);
        $Rtn = str_replace("Diez Cinco", "Quince", $Rtn);
        $Rtn = str_replace("Diez Seis", "Dieciseis", $Rtn);
        $Rtn = str_replace("Diez Siete", "Diecisiete", $Rtn);
        $Rtn = str_replace("Diez Ocho", "Dieciocho", $Rtn);
        $Rtn = str_replace("Diez Nueve", "Diecinueve", $Rtn);
        $Rtn = str_replace("Veinte Un", "Veintiun", $Rtn);
        $Rtn = str_replace("Veinte Dos", "Veintidos", $Rtn);
        $Rtn = str_replace("Veinte Tres", "Veintitres", $Rtn);
        $Rtn = str_replace("Veinte Cuatro", "Veinticuatro", $Rtn);
        $Rtn = str_replace("Veinte Cinco", "Veinticinco", $Rtn);
        $Rtn = str_replace("Veinte Seis", "Veintiseís", $Rtn);
        $Rtn = str_replace("Veinte Siete", "Veintisiete", $Rtn);
        $Rtn = str_replace("Veinte Ocho", "Veintiocho", $Rtn);
        $Rtn = str_replace("Veinte Nueve", "Veintinueve", $Rtn);

        // --------------------- FiltroUn ------------------------------
        If (substr($Rtn, 0, 1) == "M")
            $Rtn = "Un " . $Rtn;
        // --------------------- Adicionar Y ------------------------------
        for ($i = 65; $i <= 88; $i ++) {
            If ($i != 77)
                $Rtn = str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
        }
        $Rtn = str_replace("*", "a", $Rtn);
        return ($Rtn);
    }

    function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr) {
        $x = substr($x, 0, $Ptr) . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
    }

    function Nombre_Mes($numero_mes) {
        switch ($numero_mes) {

            Case 1 :
                $t = "Enero";
                break;
            Case 2 :
                $t = "Febrero";
                break;
            Case 3 :
                $t = "Marzo";
                break;
            Case 4 :
                $t = "Abril";
                break;
            Case 5 :
                $t = "Mayo";
                break;
            Case 6 :
                $t = "Junio";
                break;
            Case 7 :
                $t = "Julio";
                break;
            Case 8 :
                $t = "Agosto";
                break;
            Case 9 :
                $t = "Septiembre";
                break;
            Case 10 :
                $t = "Octubre";
                break;
            Case 11:
                $t = "Noviembre";
                break;
            Case 12:
                $t = "Diciembre";
                break;
            default :
                $t = "No existe mes";
                break;
        }

        Return $t;
    }

    function Parte($x) {
        $Rtn = '';
        $t = '';
        $i = '';
        Do {
            switch ($x) {
                Case 0 :
                    $t = "Cero";
                    break;
                Case 1 :
                    $t = "Un";
                    break;
                Case 2 :
                    $t = "Dos";
                    break;
                Case 3 :
                    $t = "Tres";
                    break;
                Case 4 :
                    $t = "Cuatro";
                    break;
                Case 5 :
                    $t = "Cinco";
                    break;
                Case 6 :
                    $t = "Seis";
                    break;
                Case 7 :
                    $t = "Siete";
                    break;
                Case 8 :
                    $t = "Ocho";
                    break;
                Case 9 :
                    $t = "Nueve";
                    break;
                Case 10 :
                    $t = "Diez";
                    break;
                Case 20 :
                    $t = "Veinte";
                    break;
                Case 30 :
                    $t = "Treinta";
                    break;
                Case 40 :
                    $t = "Cuarenta";
                    break;
                Case 50 :
                    $t = "Cincuenta";
                    break;
                Case 60 :
                    $t = "Sesenta";
                    break;
                Case 70 :
                    $t = "Setenta";
                    break;
                Case 80 :
                    $t = "Ochenta";
                    break;
                Case 90 :
                    $t = "Noventa";
                    break;
                Case 100 :
                    $t = "Cien";
                    break;
                Case 200 :
                    $t = "Doscientos";
                    break;
                Case 300 :
                    $t = "Trescientos";
                    break;
                Case 400 :
                    $t = "Cuatrocientos";
                    break;
                Case 500 :
                    $t = "Quinientos";
                    break;
                Case 600 :
                    $t = "Seiscientos";
                    break;
                Case 700 :
                    $t = "Setecientos";
                    break;
                Case 800 :
                    $t = "Ochocientos";
                    break;
                Case 900 :
                    $t = "Novecientos";
                    break;
                Case 1000 :
                    $t = "Mil";
                    break;
                Case 1000000 :
                    $t = "Millón";
                    break;
            }

            If ($t == $this->Void) {
                $i = $i + 1;
                $x = $x / 1000;
                If ($x == 0)
                    $i = 0;
            } else
                break;
        } while ($i != 0);

        $Rtn = $t;
        Switch ($i) {
            Case 0 :
                $t = $this->Void;
                break;
            Case 1 :
                $t = " Mil";
                break;
            Case 2 :
                $t = " Millones";
                break;
            Case 3 :
                $t = " Billones";
                break;
        }
        return ($Rtn . $t);
    }

}

class RegistradorOrden {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;

    function __construct($lenguaje, $sql, $funcion) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
    }

    function documento() {



        $conexion = "contractual";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $conexionSICA = "sicapital";
        $DBSICA = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionSICA);

        $conexionAgora = "agora";
        $esteRecursoDBAgora = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionAgora);

        $conexionFrameWork = "estructura";
        $DBFrameWork = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionFrameWork);

        $conexionCore = "core";
        $DBCore = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionCore);

        $directorio = $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque');

        $datosContrato = array(
            0 => $_REQUEST ['numero_contrato'],
            1 => $_REQUEST ['vigencia']
        );

        // Obtiene las Polizas Asociadas Al contrato
        $cadenaSql = $this->miSql->getCadenaSql('polizasDocumento', $datosContrato);
        $polizas = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        // Obtiene la  Toda la  Informacion de la tabla contrato general

        $cadenaSql = $this->miSql->getCadenaSql('infoContratoGeneralDocumento', $datosContrato);
        $contrato = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $contrato = $contrato[0];




        // Obtiene las Polizas Asociadas Al contrato
        $cadenaSqlelaboro = $this->miSql->getCadenaSql('obtenerInformacionElaborador', $contrato['usuario']);
        $usuario = $DBFrameWork->ejecutarAcceso($cadenaSqlelaboro, "busqueda");


        $cadenaSql = $this->miSql->getCadenaSql('ordenadorDocumento', $contrato ['ordenador_gasto']);
        $ordenador = $DBSICA->ejecutarAcceso($cadenaSql, "busqueda");
        $ordenador = $ordenador [0];
//
//
//        $cadenaSql = $this->miSql->getCadenaSql('ordenadorArgoDocumento', $contrato ['ordenador_gasto']);
//        $ordenadorInfoExtra = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('consultaContratistaDocumento', $contrato ['contratista']);
        $contratista = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");
     
        
        

        $contratistaContacto = '';
        if ($contratista [1]) {
            $contratistaContacto = $contratista [1]['numero_tel'];
        }
       
        $contratista = $contratista [0];

        $cadenaSql = $this->miSql->getCadenaSql('consultarElementosOrden', $datosContrato);
        $ElementosOrden = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        $cadenaSqlServicios = $this->miSql->getCadenaSql('consultarServiciosOrden', $datosContrato);
        $ServiciosOrden = $esteRecursoDB->ejecutarAcceso($cadenaSqlServicios, "busqueda");


        $cadenaSql = $this->miSql->getCadenaSql('consultaParametro', $contrato ['forma_pago']);
        $formaPago = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $formaPago = $formaPago[0][0];


        $cadenaSql = $this->miSql->getCadenaSql('consultaParametro', $contrato ['unidad_ejecucion']);
        $plazo = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $plazo = $plazo[0][0];

        $cadenaSql = $this->miSql->getCadenaSql('consultaParametro', $contrato ['modalidad_seleccion']);
        $modalidad_seleccion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $modalidad_seleccion = $modalidad_seleccion[0][0];

        $meses = 0;
        $dias = 0;

        if ($contrato ['unidad_ejecucion'] == '205') {
            $meses = $contrato['plazo_ejecucion'] / 30;
            if ($meses > 1) {
                $meses = floor($meses);
                $parcial = $meses * 30;
                $dias = $contrato['plazo_ejecucion'] - $parcial;
                $plazo = $meses . " mes(es) y " . $dias . " dia(s) ";
            } else {
                $plazo = $contrato['plazo_ejecucion'] . " dia(s) ";
                $dias = $contrato['plazo_ejecucion'];
            }
        } elseif ($contrato ['unidad_ejecucion'] == '206') {
            $plazo = $contrato['plazo_ejecucion'] . " Mes(es) ";
            $meses = $contrato['plazo_ejecucion'];
            $dias = 2;
        } else {
            $meses = $contrato['plazo_ejecucion'] * 12;
            $plazo = $meses . " mes(es) ";
        }


        $fecha_inicio_poliza = date_create($polizas[0][2]);
        date_add($fecha_inicio_poliza, date_interval_create_from_date_string("'" . $meses . " months'"));
        date_add($fecha_inicio_poliza, date_interval_create_from_date_string("'" . $dias . " days'"));

        $dia_final_contrato = date_format($fecha_inicio_poliza, 'd');
        $mes_final_contrato = date_format($fecha_inicio_poliza, 'm');
        $ano_final_contrato = date_format($fecha_inicio_poliza, 'Y');



        $cadenaSql = $this->miSql->getCadenaSql('consultaTipoContrato', $contrato ['tipo_contrato']);
        $tipo_contrato = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $tipo_contrato = $tipo_contrato[0][0];

        $datosContrato = array($_REQUEST ['numero_contrato'], $_REQUEST ['vigencia']);
        $cadenaSql = $this->miSql->getCadenaSql('ConsultarperfilCPS', $datosContrato);
        $perfil = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $perfil = $perfil[0];

        $cadenaSql = $this->miSql->getCadenaSql('ConsultarNombrePerfil', $perfil['perfil']);
        $nombreperfil = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");
        $nombreperfil = $nombreperfil[0]['valor_parametro'];

        $sqlAdicionesPresupuesto = $this->miSql->getCadenaSql('consultarAdcionesPresupuesto', $datosContrato);
        $adicionesPresupuesto = $esteRecursoDB->ejecutarAcceso($sqlAdicionesPresupuesto, "busqueda");


        $sqlAdicionesTiempo = $this->miSql->getCadenaSql('consultarAdcionesTiempo', $datosContrato);
        $adicionesTiempo = $esteRecursoDB->ejecutarAcceso($sqlAdicionesTiempo, "busqueda");

        $sqlAdicionesAnulaciones = $this->miSql->getCadenaSql('consultarAnulaciones', $datosContrato);
        $anulaciones = $esteRecursoDB->ejecutarAcceso($sqlAdicionesAnulaciones, "busqueda");

        $sqlAdicionesSuspension = $this->miSql->getCadenaSql('consultarSuspensiones', $datosContrato);
        $suspensiones = $esteRecursoDB->ejecutarAcceso($sqlAdicionesSuspension, "busqueda");

        $sqlCesiones = $this->miSql->getCadenaSql('consultaCesiones', $datosContrato);
        $cesiones = $esteRecursoDB->ejecutarAcceso($sqlCesiones, "busqueda");

        $sqlCambiosSupervisor = $this->miSql->getCadenaSql('ConsultacambioSupervisor', $datosContrato);
        $cambioSupervisor = $esteRecursoDB->ejecutarAcceso($sqlCambiosSupervisor, "busqueda");

        $sqlOtras = $this->miSql->getCadenaSql('ConsultaOtras', $datosContrato);
        $otras = $esteRecursoDB->ejecutarAcceso($sqlOtras, "busqueda");

        $sqlEstadoContrato = $this->miSql->getCadenaSql('consultarEstadoContrato', $datosContrato);
        $estadoContrato = $esteRecursoDB->ejecutarAcceso($sqlEstadoContrato, "busqueda");


        $numeroContratoDin = $_REQUEST ['numero_contrato'];
        if ($estadoContrato[0]['estado'] != 1) {
            $sqlConsecutivo_unico_contrato = $this->miSql->getCadenaSql('consultarConsecutivoUnicoSuscrito', $datosContrato);
            $consecutivo_unico_contrato = $esteRecursoDB->ejecutarAcceso($sqlConsecutivo_unico_contrato, "busqueda");


            $fechaSucripcion = explode("-", $consecutivo_unico_contrato[0]['fecha_suscripcion']);
            setlocale(LC_TIME, "es_ES.UTF-8");
            $fechaSucripcion = strftime("%A, %d de %B de %Y", gmmktime(12, 0, 0, $fechaSucripcion[1], $fechaSucripcion[2], $fechaSucripcion[0]));

            $parametros = array(
                'ordenador_gasto' => $contrato ['ordenador_gasto'],
                'fecha_suscripcion' => $consecutivo_unico_contrato[0]['fecha_suscripcion'],
            );

            $cadenaSql = $this->miSql->getCadenaSql('ordenadorArgoDocumento', $parametros);
            $ordenadorInfoExtra = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            $numeroContratoDin = $consecutivo_unico_contrato[0]['numero_contrato_suscrito'];
        } else {

            $parametros = array(
                'ordenador_gasto' => $contrato ['ordenador_gasto'],
                'fecha_suscripcion' => date('Y-m-d'),
            );

            $cadenaSql = $this->miSql->getCadenaSql('ordenadorArgoDocumento', $parametros);
            $ordenadorInfoExtra = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        }




        $datos_disponibilidad = array(0 => $_REQUEST ['numero_contrato'], 1 => $_REQUEST['vigencia']);
        $cadena_sql = $this->miSql->getCadenaSql('ConsultarDisponibilidadesContrato', $datos_disponibilidad);
        $disponibilidades = $esteRecursoDB->ejecutarAcceso($cadena_sql, "busqueda");
        $infoCdp = "";
        $infoRubro = "";
        for ($index = 0; $index < count($disponibilidades); $index++) {

            $datos_cdp = array('numero_disponibilidad' => $disponibilidades[$index]['numero_cdp'], 'vigencia' => $disponibilidades[$index]['vigencia_cdp'], 'unidad_ejecutora' => $_REQUEST['unidad']);
            $sqlInfoCDP = $this->miSql->getCadenaSql('obtenerInfoCdp', $datos_cdp);
            $rubro = $DBSICA->ejecutarAcceso($sqlInfoCDP, "busqueda");

            $date = date_create($rubro[0]['FECHA_REGISTRO']);
            $fecha_nueva = date_format($date, 'Y-m-d');

            $fechaCDP = explode("-", $fecha_nueva);
            setlocale(LC_TIME, "es_ES.UTF-8");
            $fechaCDP = strftime("%A, %d de %B de %Y", gmmktime(12, 0, 0, $fechaCDP[1], $fechaCDP[2], $fechaCDP[0]));
            $infoCdp = $infoCdp . " " . $disponibilidades[$index]['numero_cdp'] . " expedido el " . $fechaCDP . ", ";
            $infoRubro = $infoRubro . " " . $rubro[0]['DESCRIPCION'];
        }
        $solicitud_objeto = $rubro[0]['JUSTIFICACION'];



        $cadenaSql = $this->miSql->getCadenaSql('ObtenerInfosupervisor', $contrato ['supervisor']);
        $supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

//        $cadenaSql = $this->miSql->getCadenaSql('ObtenerInfosupervisorDetalle', $supervisor [0]['documento']);
//        $info_detalle_supervisor = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");
//        
//        $supervisor_contrato=" Nombre: " .$supervisor [0]['nombre'];
        $supervisor_contrato = " Cargo: " . $supervisor [0]['cargo'];
//        $supervisor_contrato.=" , Cédula de Ciudadanía: " .$supervisor [0]['documento'].". ";


           //obtener jefe juridica para firma
        $cadenaSql = $this->miSql->getCadenaSql('buscar_jefe_juridica');
        $jefe_juridica = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda"); 

        $funcionLetras = new EnLetras ();

        $valorContrato = $funcionLetras->ValorEnLetras($contrato['valor_contrato'], ' Pesos ');







                


        if ($contratista['tipopersona'] == 'NATURAL') {

            $cadenaSql = $this->miSql->getCadenaSql('consultaTipoDocumento', $contratista ['num_documento']);
            $tipoDocumento = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");

            $InfoContratistaBasica = strtoupper($contratista['nom_proveedor']) . " (" . $tipoDocumento[0][0] . "  " . $contratista['num_documento'] . ") ";

            $InfoContratista = strtoupper($contratista['nom_proveedor']) . ", mayor de edad y vecino de esta ciudad, identificado con " . $tipoDocumento[0][0] . " No. " . $contratista['num_documento'] . " expedida en " . $tipoDocumento[0][1];

            $InfoContratistaContacto = '';
            if ($contratistaContacto == '') {
                $InfoContratistaContacto = "Nombre: " . strtoupper($contratista['nom_proveedor']) . ", Dirección: " . $contratista['direccion'] . ", Teléfono: " . $contratista['numero_tel'] . ", Correo: " . $contratista['correo'];
            } else {
                $InfoContratistaContacto = "Nombre: " . strtoupper($contratista['nom_proveedor']) . ", Dirección: " . $contratista['direccion'] . ", Teléfonos: " . $contratista['numero_tel'] . "-" . $contratistaContacto . ", Correo: " . $contratista['correo'];
            }
        } elseif ($contratista['tipopersona'] == 'JURIDICA') {


            $cadenaSql = $this->miSql->getCadenaSql('consultaRepresentanteLegal', $contrato ['contratista']);
            $representanteLegal = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");


            $cadenaSql = $this->miSql->getCadenaSql('consultaDigitoVerificacion', $contratista['num_documento']);
            $digitoVerificacion = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");



            if ($representanteLegal[0]['cargo'] === 'REPRESENTANTE LEGAL' || $representanteLegal[0]['cargo'] === ' ') {

                 $InfoContratista =  strtoupper($contratista['nom_proveedor']) . " con NIT " . 
                                               $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . 
                                              " Representada legalmente por " . $representanteLegal[0]['nombre'] . ", mayor de edad y vecino de esta ciudad, identificado con " . 
                                                $representanteLegal[0]['tipo_documento'] . " No. " . $representanteLegal[0]['documento'] .
                                                " expedida en " . $representanteLegal[0]['ciudad'];



              /*  $InfoContratista = $representanteLegal[0]['nombre'] . ", mayor de edad y vecino de esta ciudad, identificado con " . $representanteLegal[0]['tipo_documento'] . " No. " .
                          $representanteLegal[0]['documento'] .
                        " expedida en " . $representanteLegal[0]['ciudad'] .
                        ", quien actúa en nombre y representación legal de " . strtoupper($contratista['nom_proveedor']) .
                        " con NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0];*/

                $InfoContratistaBasica = strtoupper($contratista['nom_proveedor']) . " ( NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . ") ";
                if ($contratistaContacto == '') {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfono: " . $contratista['numero_tel'] . ", Correo: " . $contratista['correo'];
                } else {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfonos: " . $contratista['numero_tel'] . "-" . $contratistaContacto . ", Correo: " . $contratista['correo'];
                }
            } else {

                $InfoContratista =  strtoupper($contratista['nom_proveedor']) . " con NIT " . 
                                               $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . 
                                              " Representada legalmente por " . $representanteLegal[0]['nombre'] . " en calidad de " . $representanteLegal[0]['cargo'] . ", mayor de edad y vecino de esta ciudad, identificado con " . 
                                                $representanteLegal[0]['tipo_documento'] . " No. " . $representanteLegal[0]['documento'] .
                                                " expedida en " . $representanteLegal[0]['ciudad'];


          /*      $InfoContratista = $representanteLegal[0]['nombre'] . ", mayor de edad y vecino de esta ciudad, identificado con " .
                        $representanteLegal[0]['tipo_documento'] . " No. " . $representanteLegal[0]['documento'] .
                        " expedida en " . $representanteLegal[0]['ciudad'] .
                        ", quien actúa en nombre y representación legal " . " en calidad de " . $representanteLegal[0]['cargo'] . " de " . strtoupper($contratista['nom_proveedor']) .
                        " con NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0];*/

                $InfoContratistaBasica = strtoupper($contratista['nom_proveedor']) . " ( NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . ") ";

                $InfoContratistaContacto = '';
                if ($contratistaContacto == '') {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfono: " . $contratista['numero_tel'] . ", Correo: " . $contratista['correo'];
                } else {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfonos: " . $contratista['numero_tel'] . "-" . $contratistaContacto . ", Correo: " . $contratista['correo'];
                }
            }
        } else {
            $cadenaSql = $this->miSql->getCadenaSql('consultaRepresentanteLegal', $contrato ['contratista']);
            $representanteLegal = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");




            $cadenaSql = $this->miSql->getCadenaSql('consultaDigitoVerificacion', $contratista['num_documento']);
            $digitoVerificacion = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");



            if ($representanteLegal[0]['cargo'] === 'REPRESENTANTE LEGAL' || $representanteLegal[0]['cargo'] === ' ') {
                
                 $InfoContratista =  strtoupper($contratista['nom_proveedor']) . " con NIT " . 
                                               $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . 
                                              " Representada legalmente por " . $representanteLegal[0]['nombre'] . ", mayor de edad y vecino de esta ciudad, identificado con " . 
                                                $representanteLegal[0]['tipo_documento'] . " No. " . $representanteLegal[0]['documento'] .
                                                " expedida en " . $representanteLegal[0]['ciudad'];



                /*$InfoContratista = $representanteLegal[0]['nombre'] . ", mayor de edad y vecino de esta ciudad, identificado con " . $representanteLegal[0]['tipo_documento'] . " No. " . $representanteLegal[0]['documento'] .
                        " expedida en " . $representanteLegal[0]['ciudad'] .
                        ", quien actúa en nombre y representación legal de " . strtoupper($contratista['nom_proveedor']) .
                        " con NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0];*/

                $InfoContratistaBasica = strtoupper($contratista['nom_proveedor']) . " ( NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . ") ";

                $InfoContratistaContacto = '';
                if ($contratistaContacto == '') {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfono: " . $contratista['numero_tel'] . ", Correo: " . $contratista['correo'];
                } else {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfonos: " . $contratista['numero_tel'] . "-" . $contratistaContacto . ", Correo: " . $contratista['correo'];
                }
            } else {

                 $InfoContratista =  strtoupper($contratista['nom_proveedor']) . " con NIT " . 
                                               $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . 
                                              " Representada legalmente por " . $representanteLegal[0]['nombre'] . " en calidad de " . $representanteLegal[0]['cargo'] . ", mayor de edad y vecino de esta ciudad, identificado con " . 
                                                $representanteLegal[0]['tipo_documento'] . " No. " . $representanteLegal[0]['documento'] .
                                                " expedida en " . $representanteLegal[0]['ciudad'];

                /*$InfoContratista = $representanteLegal[0]['nombre'] . ", mayor de edad y vecino de esta ciudad, identificado con " .
                        $representanteLegal[0]['tipo_documento'] . " No. " . $representanteLegal[0]['documento'] .
                        " expedida en " . $representanteLegal[0]['ciudad'] .
                        ", quien actúa en nombre y representación legal " . " en calidad de " . $representanteLegal[0]['cargo'] . " de " . strtoupper($contratista['nom_proveedor']) .
                        " con NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0];*/

                $InfoContratistaBasica = strtoupper($contratista['nom_proveedor']) . " ( NIT " . $contratista['num_documento'] . "-" . $digitoVerificacion[0][0] . ") ";

                $InfoContratistaContacto = '';
                if ($contratistaContacto == '') {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfono: " . $contratista['numero_tel'] . ", Correo: " . $contratista['correo'];
                } else {
                    $InfoContratistaContacto = "Nombre: " . strtoupper($representanteLegal[0]['nombre']) . ", Dirección: " . $contratista['direccion'] . ", Teléfonos: " . $contratista['numero_tel'] . "-" . $contratistaContacto . ", Correo: " . $contratista['correo'];
                }
            }
        }


        $contarlineas = strlen($contrato['objeto_contrato'] . $contrato['actividades'] . $solicitud_objeto);

        if (is_numeric($_REQUEST['tamanoletra']) && $_REQUEST['tamanoletra'] != null) {
            $letra = $_REQUEST['tamanoletra'];
        } else {
            $letra = 10;
        }


        if ($contratista['regimen_contributivo'] == 'COMUN') {
            $infoRegimenSimplificado = "";
        } else {
            $infoRegimenSimplificado = ", incluido IVA, tasas, impuestos, contribuciones y demás retenciones a que haya lugar ";
        }



        if ($contrato['clase_contratista'] == '33') {
            $prefijo = "PERSONA: ";
        } else {
            $prefijo = "SOCIEDAD TEMPORAL: ";
        }

        $funcionLetras = new EnLetras ();

        //busqueda para contrato arrendamiento





      
        $forma_pago = $contrato['descripcion_forma_pago'];







        $arregloBusqueda = array(
            'numero_contrato' => $arrendamiento[0]['numero_contrato'],
            'vigencia_contrato' => $arrendamiento[0]['vigencia']
        );

        $cadenaSql = $this->miSql->getCadenaSql('consultaArrendamientoAmparo', $datosContrato);
        $arrendamientoGeneral = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        $tablaDeAmparos = ' <table align="center" style="width:100% ;border: 1px solid black;"> 
            <tr>            
              <td style="text-align:center;font-weight:bold;border: 1px solid black;">AMPARO</td> 
              <td style="text-align:center;font-weight:bold;border: 1px solid black;">SUFICIENCIA</td> 
              <td style="text-align:center;font-weight:bold;border: 1px solid black;">DESCRIPCION</td> 
           </tr> 
          ';

        $contadorArrend = 0;

        while ($contadorArrend < count($arrendamientoGeneral)) {

            $cadenaAmparosParametros = $this->miSql->getCadenaSql("obtenerAmparosParametros2", $arrendamientoGeneral[$contadorArrend]['tipo_amparo']);
            $amparosParametros = $DBCore->ejecutarAcceso($cadenaAmparosParametros, "busqueda");





            $tablaDeAmparos.= '<tr> ';
            $tablaDeAmparos.= '<td>' . $amparosParametros[0]['nombre'] . '</td> ';
            $tablaDeAmparos.= '<td>' . $arrendamientoGeneral[$contadorArrend]['suficiencia'] . "%" . '</td> ';
            $tablaDeAmparos.= '<td>' . $arrendamientoGeneral[$contadorArrend]['vigencia'] . '</td> ';
            $tablaDeAmparos.= '</tr>  ';









            $contadorArrend++;
        }


        $tablaDeAmparos.='</table>';



        // ELEMENTOS Y SERVICIOS PARA CONTRATO
        
        
        if ($ElementosOrden) {
            $elementosyservicios .= "<table align='left' style='width:100%;PAGE-BREAK-AFTER: always' >

            <tr>
            <td style='width:100%;text-align:center;'><font size='1px'><b></b></font></td>
            </tr>

            </table><br><br>";


            $elementosyservicios .= "<table align='left' style='width:100%;' >

            <tr>
            <td style='width:100%;text-align:center;'><font size='1px'><p><b>ANEXOS</b></p></font></td>
            </tr>

        </table><br><br>";

            $elementosyservicios .= "<table align='left' style='width:100%;' >

            <tr>
            <td style='width:100%;text-align:left;'><font size='1px'><p><b>".strtoupper($tipo_contrato). " NUMERO  _________</b></font></p></td>
            </tr>

        </table><br><br>";

             $elementosyservicios .= "<table align='left' style='width:100%;' >

            <tr>
            <td style='width:100%;text-align:left;'><font size='1px'><p><b>".strtoupper($tipo_contrato). " CELEBRADA ENTRE LA UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS Y ".strtoupper($contratista['tipopersona'])."</b></font></p></td>
            </tr>

        </table><br><br>";





            $elementosyservicios .= "
        <table style='width:100%;'>
        <tr>
        <td  style='width:100%;text-align=center;'><p><b>ELEMENTOS ASOCIADOS</b></p></td><br>
        </tr>
        </table>
        <table style='width:100%;'>
        <tr>
        <td style='width:5%;text-align=center;'><b><center>No.</center></b></td>
                <td style='width:13%;text-align=center;'><b><center>Nombre</center></b></td>
                <td style='width:23%;text-align=center;'><b><center>Descripción</center></b></td>
        <td style='width:7%;text-align=center;'><b><center>Unidad</center></b></td>
        <td style='width:7%;text-align=center;'><b><center>Cantidad</center></b></td>       
        <td style='width:20%;text-align=center;'><b><center>Valor Unitario($)</center></b></td>
        <td style='width:5%;text-align=center;'><b><center>Iva</center></b></td>
        <td style='width:20%;text-align=center;'><b><center>Total</center></b></td>
        </tr>
        </table>
        <table class='mainelementos' style='width:100%;'>";

            $sumatoriaTotal = 0;

            $sumatoriaIva = 0;
            $sumatoriaSubtotal = 0;
            $j = 1;


            

            foreach ($ElementosOrden as $valor => $it) {
                
                $valor_total=$it ['valor'] * $it ['cantidad'];
                
                $valor_total_iva= $valor_total * ($it ['nombre_iva']/100);
                $valor_final=$valor_total_iva + $valor_total;
                
                
                $elementosyservicios .= "<tr>";
                $elementosyservicios .= "<td style='width:5%;text-align=center;'><p><center>" . $j . "</center></p></td>";
                $elementosyservicios .= "<td style='width:13%;text-align=center;'><p><center>" . $it ['nombre'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:23%;text-align=center;'><p><center>" . $it ['descripcion'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:7%;text-align=center;'><p><center>" . $it ['unidad'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:7%;text-align=center;'><p><center>" . $it ['cantidad'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:20%;text-align=center;'><p><center>$ " . number_format($it ['valor'], 2, ",", ".") . "</center></p></td>";
                $elementosyservicios .= "<td style='width:5%;text-align=center;'><p><center>" . $it ['nombre_iva'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:20%;text-align=center;'><p><center>$ " . number_format($valor_final, 2, ",", ".") . "</center></p></td>";
                $elementosyservicios .= "</tr>";

                $sumatoriaTotal = $sumatoriaTotal +  $valor_final;
                $sumatoriaSubtotal = $sumatoriaSubtotal +  $valor_total;
                $sumatoriaIva = $sumatoriaIva + $valor_total_iva;
                $j ++;
            }
            
     

        //------------- Redondeo Valores Totales --------------------------------------

        $sumatoriaTotal = round($sumatoriaTotal);
        $sumatoriaSubtotal = round($sumatoriaSubtotal);
        $sumatoriaIva = round($sumatoriaIva);

        //-----------------------------------------------------------------------------

            $elementosyservicios .= "</table>";

            $elementosyservicios .= "       <table class='mainelementos' style='width:100%;'>
        <tr>

        <td style='width:75%;text-align=left;'><p><b>SUBTOTAL  : </b></p></td>
        <td style='width:25%;text-align=center;'><p><b>$" . number_format($sumatoriaSubtotal, 2, ",", ".") . "</b></p></td>
        </tr>
        <tr>

        <td style='width:75%;text-align=left;'><p><b>TOTAL IVA  : </b></p></td>
        <td style='width:25%;text-align=center;'><p><b>$" . number_format($sumatoriaIva, 2, ",", ".") . "</b></p></td>
        </tr>

        <tr>

        <td style='width:75%;text-align=center;'><p><b>TOTAL  : </b></p></td>
        <td style='width:25%;text-align=center;'><p><b>$" . number_format($sumatoriaTotal, 2, ",", ".") . "</b></p></td>
        </tr>


    </table>
                ";

            $funcionLetras = new EnLetras ();

            $Letras = $funcionLetras->ValorEnLetras($sumatoriaTotal, ' Pesos ');

            $elementosyservicios .= "<table class='mainelementos' style='width:100%;'>
        <tr>
        <td style='width:100%;text-align=right;text-transform:uppercase;'><p><b>" . $Letras . "</b></p></td>
        </tr>

        </table><br><br><br>";

             $elementosyservicios .="

            <table align='left' style='width:100%;'>
        <tr>
        <td style='width:100%;text-align:justify;'>Para constancia se firma, a los, </td>
        </tr>

        </table>";

             $elementosyservicios .=" <table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>

                         <tr>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________</td>
            </tr>
            <tr>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>".$contratista['num_documento']."-".strtoupper($contratista['nom_proveedor'])."</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'>".$ordenadorInfoExtra[0]['documento']."-".$ordenador['NOMBRE']."</td>
            </tr>
            <tr>

                        <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'> CONTRASTISTA</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>ORDENADOR GASTO - ".$ordenador['ORDENADOR']."</td>
            </tr>
            </table><br><br><br><br><table class='bordes'>
                        <tr>
                        <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>Elaborado por</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>".strtoupper($usuario[0]['nombre'])." ". strtoupper($usuario[0]['apellido'])."</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>                        </td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>                        </td>
            </tr>
             <tr>
                        <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>Aprobado por </td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>TULIO BERNARDO ISAZA SANTAMARIA</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>JEFE SECCIÓN DE COMPRAS</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>                          </td></tr>
            </table><br><br>
            <p class='pie'>

                            UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS NIT: 899.999.230-7
                            CARRERA 7 No. 40-53 PISO 7. TELEFONO 3239300 EXT. 2609 -2605<br>
                            Institución Acreditada de Alta Calidad según Resolución 23096 del
                            15 de Diciembre de 2016 del Ministerio de Educación Nacional<br>
                            www.udistrital.edu.co

                        </p> ";
        }
        if ($ServiciosOrden) {

            $elementosyservicios .= "<table align='left' style='width:100%;PAGE-BREAK-AFTER: always' >

            <tr>
            <td style='width:100%;text-align:center;'><font size='1px'><b></b></font></td>
            </tr>

            </table><br><br>";


            $elementosyservicios .= "<table align='left' style='width:100%;' >

            <tr>
            <td style='width:100%;text-align:center;'><font size='1px'><p><b>ANEXOS</b></p></font></td>
            </tr>

        </table><br><br>";

             $elementosyservicios .= "<table align='left' style='width:100%;' >

            <tr>
            <td style='width:100%;text-align:left;'><font size='1px'><p><b>".strtoupper($tipo_contrato). " NUMERO  _________</b></font></p></td>
            </tr>

        </table><br><br>";

             $elementosyservicios .= "<table align='left' style='width:100%;' >

            <tr>
            <td style='width:100%;text-align:left;'><font size='1px'><p><b>".strtoupper($tipo_contrato). " CELEBRADA ENTRE LA UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS Y ".strtoupper($contratista['tipopersona'])."</b></font></p></td>
            </tr>

        </table><br><br>";



            $elementosyservicios .= "<br>
        <table class='mainelementos' style='width:100%;'>
        <tr>
        <td style='width:100%;text-align=center;'><p><b>SERVICIOS </b></p></td><br>
        </tr>
        </table>
        <table class='mainelementos' style='width:100%;'>
        <tr>
        <td style='width:2%;text-align=center;'><b><center>No.</center></b></td>
                <td style='width:13%;text-align=center;'><b><center>Nombre</center></b></td>
                <td style='width:20%;text-align=center;'><b><center>Descripción</center></b></td>
                <td style='width:7%;text-align=center;'><b><center>Tiempo<br>Ejecución<br>(Días)</center></b></td>
        <td style='width:7%;text-align=center;'><b><center>Unidad</center></b></td>
        <td style='width:7%;text-align=center;'><b><center>Cantidad</center></b></td>       
        <td style='width:19%;text-align=center;'><b><center>Valor Unitario($)</center></b></td>
        <td style='width:5%;text-align=center;'><b><center>Iva</center></b></td>
        <td style='width:19%;text-align=center;'><b><center>Total</center></b></td>
        </tr>
        </table>
        <table class='mainelementos' style='width:100%;'>";




            $sumatoriaTotalServicios = 0;
            $sumatoriaSubtotalServicios = 0;
            $sumatoriaIvaServicios = 0;

            $c = 1;


            foreach ($ServiciosOrden as $valor => $it) {
                
                $valor_total=$it ['valor'] * $it ['cantidad'];
                
                $valor_total_iva= $valor_total * ($it ['nombre_iva']/100);
                $valor_final=$valor_total_iva + $valor_total;
                
                $elementosyservicios .= "<tr>";
                $elementosyservicios .= "<td style='width:2%;text-align=center;'><p><center>" . $c . "</center></p></td>";
                $elementosyservicios .= "<td style='width:13%;text-align=center;'><p><center>" . $it ['nombre'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:20%;text-align=center;'><p><center>" . $it ['descripcion'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:7%;text-align=center;'><p><center>" . $it ['tiempo_ejecucion'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:7%;text-align=center;'><p><center>" . $it ['unidad'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:7%;text-align=center;'><p><center>" . $it ['cantidad'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:19%;text-align=center;'><p><center>$ " . number_format($it ['valor'], 2, ",", ".") . "</center></p></td>";
                $elementosyservicios .= "<td style='width:5%;text-align=center;'><p><center>" . $it ['nombre_iva'] . "</center></p></td>";
                $elementosyservicios .= "<td style='width:19%;text-align=center;'><p><center>$ " . number_format($valor_final, 2, ",", ".") . "</center></p></td>";
                $elementosyservicios .= "</tr>";

                $sumatoriaTotalServicios = $sumatoriaTotalServicios + $valor_final;
                $sumatoriaSubtotalServicios = $sumatoriaSubtotalServicios +  $valor_total;
                $sumatoriaIvaServicios = $sumatoriaIvaServicios + $valor_total_iva;
                $c ++;
            }


        //------------- Redondeo Valores Totales --------------------------------------

        $sumatoriaTotalServicios = round($sumatoriaTotalServicios);

        //-----------------------------------------------------------------------------

            $elementosyservicios .= "</table>";

            $elementosyservicios .= "       <table class='mainelementos' style='width:100%;'>
    
<tr>

        <td style='width:75%;text-align=left;'><p><b>SUBTOTAL  : </b></p></td>
        <td style='width:25%;text-align=center;'><p><b>$" . number_format($sumatoriaSubtotalServicios, 2, ",", ".") . "</b></p></td>
        </tr>
        <tr>

        <td style='width:75%;text-align=left;'><p><b>TOTAL IVA  : </b></p></td>
        <td style='width:25%;text-align=center;'><p><b>$" . number_format($sumatoriaIvaServicios, 2, ",", ".") . "</b></p></td>
        </tr>

        <tr>

        <td style='width:75%;text-align=center;'><p><b>TOTAL  : </b></p></td>
        <td style='width:25%;text-align=center;'><p><b>$" . number_format($sumatoriaTotalServicios, 2, ",", ".") . "</b></p></td>
        </tr>
                



    </table>
                ";

            $LetrastotalServicios = $funcionLetras->ValorEnLetras($sumatoriaTotalServicios, ' Pesos ');

            $elementosyservicios .= "<table class='mainelementos' style='width:100%;'>
        <tr>

        <td style='width:100%;text-align=center;text-transform:uppercase;'><p><b>" . $LetrastotalServicios . "</b></p></td>
        </tr>


                
        </table>";






            $elementosyservicios .= "<br><br><table class='mainelementos' style='width:100%;'>
        <tr>

        <td style='width:75%;text-align=left;'><p><b>TOTAL ORDEN: </b></p></td>
        <td style='width:25%;text-align=center;'><p><b>$" . number_format($sumatoriaTotalServicios + $sumatoriaTotal, 2, ",", ".") . "</b></p></td>
        </tr>


    </table>
                ";

            $LetrasTotalOrden = $funcionLetras->ValorEnLetras($sumatoriaTotalServicios + $sumatoriaTotal, ' Pesos ');

            $elementosyservicios .= "<table class='mainelementos' style='width:100%;'>
        <tr>

        <td style='width:100%;text-align=left;text-transform:uppercase;'><p><b>" . $LetrasTotalOrden . "</b></p></td>
        </tr>

        </table>";
              $elementosyservicios .="<br><br>

            <table align='left' style='width:100%;'>
        <tr>
        <td style='width:100%;text-align:justify;'>Para constancia se firma, a los, </td>
        </tr>

        </table>";

             $elementosyservicios .=" <table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>

                         <tr>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________</td>
            </tr>
            <tr>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>".$contratista['num_documento']."-".strtoupper($contratista['nom_proveedor'])."</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'>".$ordenadorInfoExtra[0]['documento']."-".$ordenador['NOMBRE']."</td>
            </tr>
            <tr>

                        <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'> CONTRASTISTA</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>ORDENADOR GASTO - ".$ordenador['ORDENADOR']."</td>
            </tr>
            </table><br><br><br><br><table class='bordes'>
                        <tr>
                        <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>Elaborado por</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>".strtoupper($usuario[0]['nombre'])." ". strtoupper($usuario[0]['apellido'])."</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>                        </td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>                        </td>
            </tr>
             <tr>
                        <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>Aprobado por </td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>TULIO BERNARDO ISAZA SANTAMARIA</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>JEFE SECCIÓN DE COMPRAS</td>
            <td class='sinespacionInferior' style='width:50%;text-align:left;background:#FFFFFF ; '>                          </td></tr>
            </table><br><br>
            <p class='pie'>

                            UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS NIT: 899.999.230-7
                            CARRERA 7 No. 40-53 PISO 7. TELEFONO 3239300 EXT. 2609 -2605<br>
                            Institución Acreditada de Alta Calidad según Resolución 23096 del
                            15 de Diciembre de 2016 del Ministerio de Educación Nacional<br>
                            www.udistrital.edu.co

                        </p> ";
        }




        //-------------------------------------

        $lugarEjecucion = $contrato['lugar_ejecucion'];

        $cadenaSql = $this->miSql->getCadenaSql('consultaLugarEjecucion', $lugarEjecucion);
        $direccionEjecucion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        if($ordenadorInfoExtra[0]['rol_ordenador']=='RECTOR'){
             $RevisoRectoria= '   <tr> 
                        <td style="border-width: 1px;text-align:center;"><b>REVISÓ</b> </td> 
                        <td style="border-width: 1px;text-align:center;">Milena Isabel Rubiano Rojas </td> 
                        <td style="border-width: 1px;text-align:center;">Asesora de rectoría</td> 
                        <td style="border-width: 1px;text-align:center;"></td> 
                       </tr>  ';

             $ParagrafoResponsabilidad= '<table align="center" style="width:75% ; border: 1  ;"> 
                       <tr> 
                       <td style="border-width: 1px;text-align:center;">Los arriba firmantes declaramos que hemos revisado el presente documento y lo encontramos ajustado a las normas y disposiciones, legales y/o técnicas aplicables y vigentes y, por lo tanto, bajo nuestra responsabilidad, lo presentamos para la firma del remitente. </td>
                       </tr> 
                       </table></p>';
        }
        else{
            $RevisoRectoria='';
             $ParagrafoResponsabilidad='';
        }

        
        $cadenaSql = $this->miSql->getCadenaSql('consultaPlantilla', array('tipo_contrato' => $contrato['tipo_contrato'], 'tipo_plantilla' => 'plantillaSuministro',  'fecha_vigencia' => $contrato['fecha_registro']));
        $plantilla = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        

     /*   $cadenaSql = $this->miSql->getCadenaSql('consultaPlantilla', array('tipo_contrato' => $contrato['tipo_contrato'], 'tipo_plantilla' => 'plantillaArrendamiento'));
        $plantilla = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");*/
        $plantilla = $plantilla[0];
        $parametros = array(
            'P[DIRECTORIO_IMAGEN]' => $directorio . "/css/images/escudoud.png",
            'P[LETRA]' => $letra,
            'P[NUMERO_CONTRATO]' => $numeroContratoDin,
            'P[DOCUMENTO_PROVEEDOR]' => $contratista['num_documento'],
            'P[NOMBRE_PROVEEDOR]' => strtoupper($contratista['nom_proveedor']),
            'P[TIPO_CONTRATO]' => strtoupper($tipo_contrato),
            'P[TIPO_PERSONA]' => strtoupper($contratista['tipopersona']),
            'P[NOMBRE_ORDENADOR]' =>  $ordenadorInfoExtra[0]['nombre_ordenador'],
            'P[DOCUMENTO_ORDENADOR]' => $ordenadorInfoExtra[0]['documento'],
            'P[CIUDAD_DOCUMENTO_ORDENADOR]' => $ordenadorInfoExtra[0]['nombre'],
            'P[ORDENADOR]' => $ordenadorInfoExtra[0]['rol_ordenador'],
            'P[RESOLUCION_ORDENADOR]' => $ordenadorInfoExtra[0]['info_resolucion'],
            'P[INFO_CONTRATISTA]' => $InfoContratista,
            'P[INFO_CONTRATISTA_BASICA]' => $InfoContratistaBasica,
            'P[SOLICITUD_OBJETO]' => $solicitud_objeto,
            'P[VIGENCIA_ACTUAL]' => date(Y),
            'P[VALOR_LETRAS]' => strtoupper($valorContrato),
            'P[VALOR_NUMERO]' => number_format($contrato['valor_contrato'], 2, ",", "."),
            'P[REGIMEN_CONTRATISTA]' => $infoRegimenSimplificado,
            'P[INFO_CDP]' => $infoCdp,
            'P[INFO_RUBRO]' => $infoRubro,
            'P[CODIGO_RUBRO]' => $rubro[0]['RUBRO_INTERNO'],
            'P[OBJETO_CONTRATO]' => $contrato['objeto_contrato'],
            'P[PLAZO]' => $plazo,
            'P[DIA_FIN_CONTRATO]' => $dia_final_contrato,
            'P[MES_FIN_CONTRATO]' => $funcionLetras->Nombre_Mes($mes_final_contrato),
            'P[PERIODO_FIN_CONTRATO]' => $ano_final_contrato,
            'P[FECHA_SUSCRIPCION]' => $fechaSucripcion,
            'P[INFO_SUPERVISOR]' => $supervisor_contrato,
            'P[NOMBRE_SUPERVISOR]' => $supervisor [0]['nombre'],
            'P[DIRECCION_CATASTRAL]' => $direccionEjecucion[0][1],
            'P[TABLAAMPAROS]' => $tablaDeAmparos,
            'P[ELABORO_NOMBRE]' => strtoupper($usuario[0]['nombre']),
            'P[ELABORO_APELLIDO]' => strtoupper($usuario[0]['apellido']),
            'P[FORMA_PAGO]' => $forma_pago,
            'P[MODALIDAD_SELECCION]' => $modalidad_seleccion,
            'P[SUPERVISOR]' => strtoupper($supervisor [0]['cargo']),
            'P[INFO_CONTRATISTA_CONTACTO]' => $InfoContratistaContacto,
            'P[ELEMENTOS_SERVICIO]' => $elementosyservicios,
            'P[REVISO_RECTORIA]' => $RevisoRectoria,
            'P[PARAGRAFO_RESPONSABILIDAD]' => $ParagrafoResponsabilidad,
            'P[ACTIVIDADES]' => $contrato ['actividades'],
            'P[CARGO_JEFE_JURIDICA]' => ucwords(strtolower($jefe_juridica[0]['cargo'])),
            'P[NOMBRE_JEFE_JURIDICA]' => ucwords(strtolower($jefe_juridica[0]['nombre'])),
            'P[DOCUMENTO_JEFE:JURIDICA]' => $jefe_juridica[0]['documento'],
        );

        foreach ($parametros as $clave => $valor) {

            $plantilla['plantilla'] = str_replace($clave, $valor, $plantilla['plantilla']);
            $plantilla['estilo'] = str_replace($clave, $valor, $plantilla['estilo']);
        }

        $contenidoPagina = $plantilla['plantilla'];


        $contenidoPiePagina = "";

        $estilos = $plantilla['estilo'];


        $contenidoPaginaEncabezado = "";

        $textos = array(0 => $contenidoPaginaEncabezado, 1 => $contenidoPagina, 2 => $contenidoPiePagina, 3 => $estilos, 4 => "Contrato Suministro" . $datosContrato[0] . '-' . $datosContrato[1]);

        return $textos;
    }

}

echo "<script>javascript: alert('Fuente')></script>";

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);

$textos = $miRegistrador->documento();

$mpdf = new mPDF('', 'LETTER', 10, 'ARIAL', 20, 15, 5, 15, 7, 10);
$mpdf->AddPage();
// asignamos los estilos
$mpdf->WriteHTML($textos[3], 1);
$mpdf->setFooter('{PAGENO}');
$mpdf->SetHTMLHeader($textos[0], 'O', true);

// colocamos el html para el documento
$mpdf->WriteHTML($textos[1]);
// colocamos el html para el pie de pagina

$mpdf->setHTMLFooter($textos[2]);
$mpdf->setFooter('{PAGENO}');

// establecemos el nombre del archivo
$mpdf->Output($textos[4] . '.pdf', 'D');
?>
