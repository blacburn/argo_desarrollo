<?php

$ruta = $this->miConfigurador->getVariableConfiguracion("raizDocumento");

$host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/plugin/html2pfd/";

include ($ruta . "/plugin/html2pdf/html2pdf.class.php");

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

    function Fecha_Dias($x) {
        $t = '';
        switch ($x) {
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
            Case 11 :
                $t = "Once";
                break;
            Case 12 :
                $t = "Doce";
                break;
            Case 13 :
                $t = "Trece";
                break;
            Case 14 :
                $t = "Catorce";
                break;
            Case 15 :
                $t = "Quince";
                break;
            Case 16 :
                $t = "Dieciséis";
                break;
            Case 17 :
                $t = "Diecisiete";
                break;
            Case 18 :
                $t = "Dieciocho";
                break;
            Case 19 :
                $t = "Diecinueve";
                break;
            Case 20 :
                $t = "Veinte";
                break;
            Case 21 :
                $t = "Veintiun";
                break;
            Case 22 :
                $t = "Veintidos";
                break;
            Case 23 :
                $t = "Veintitres";
                break;
            Case 24 :
                $t = "Veinticuatro";
                break;
            Case 25 :
                $t = "Veinticinco";
                break;
            Case 26 :
                $t = "Veintiseis";
                break;
            Case 27 :
                $t = "Veintisiete";
                break;
            Case 28 :
                $t = "Veintiocho";
                break;
            Case 29 :
                $t = "Veintinueve";
                break;
            Case 30 :
                $t = "Treinta";
                break;
            Case 31 :
                $t = "Treinta y un";
                break;
        }


        return $t;
    }

    function Fecha_Mes($x) {
        $t = '';
        switch ($x) {
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
            Case 11 :
                $t = "Noviembre";
                break;
            Case 12 :
                $t = "Diciembre";
                break;
        }
        return $t;
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

//        $conexionArka = "arka";
//        $DBMArka = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexionArka);

        $directorio = $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque');


        //-------------- Se accede al Servicio de Agora para Consultar el Proveedor de la Orden de Compra -------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------------------------------               
        
        
      
        
        
        
        $datosContrato = array(
            0 => $_REQUEST ['numero_contrato'],
            1 => $_REQUEST ['vigencia'],
            'numero_contrato' => $_REQUEST ['numero_contrato'],
            'vigencia' => $_REQUEST ['vigencia']
        );

        // Obtiene Información de acta inicio

        $cadenaSql = $this->miSql->getCadenaSql('consultarCargoSupervisor', $datosContrato);
        $info_cargo_supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");



        $cadenaSql = $this->miSql->getCadenaSql('consultarActasInicio', $datosContrato);
        $actas_inicio = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        $fecha_inicio = explode("-", $actas_inicio[0]['fecha_inicio']);
        $fecha_inicio_dia = $fecha_inicio[2];
        $fecha_inicio_mes = $fecha_inicio[1];
        $fecha_inicio_ano = $fecha_inicio[0];


        $cadenaSql = $this->miSql->getCadenaSql('consultarFechaFinActa', $datosContrato);
        $fecha_fin_acta = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        $actas_inicio[0]['fecha_fin'] = $fecha_fin_acta[0][0];


        $fecha_fin = explode("-", $actas_inicio[0]['fecha_fin']);

        if($fecha_fin[2]=='31'){
                $fecha_fin[2]='30';
        }


        $fecha_fin_dia = $fecha_fin[2];
        $fecha_fin_mes = $fecha_fin[1];
        $fecha_fin_ano = $fecha_fin[0];


        $sqlConsecutivo_unico_contrato = $this->miSql->getCadenaSql('consultarConsecutivoUnicoSuscrito', $datosContrato);
        $consecutivo_unico_contrato = $esteRecursoDB->ejecutarAcceso($sqlConsecutivo_unico_contrato, "busqueda");

        // Obtiene las Polizas Asociadas Al contrato
        $cadenaSql = $this->miSql->getCadenaSql('obtenerPolizasActivas', $datosContrato);
        $polizas = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $numero_poliza = "";
        $aseguradoras = "";
        $amparos = [];
        $usuarios = "  ";

        for ($i = 0; $i < count($polizas); $i++) {

            $cadenaSqlelaboro = $this->miSql->getCadenaSql('obtenerInformacionElaborador', $polizas[$i]['usuario']);

            $usuario = $DBFrameWork->ejecutarAcceso($cadenaSqlelaboro, "busqueda");

            $usuarios = $usuarios .
                    "
                    <table align='justify' style='width:100%;' >  
                     <tr>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                         <td style='width:90%;text-align:justify;height: 60px'> Para constancia de lo anterior, se firma la presente Acta bajo la responsabilidad expresa de los que intervienen en ella: </td>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                     </tr>
                   
                    </table>  
                    
                    <table align='justify' style='width:100%;' >  
                     <tr>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                         <td style='width:45%;text-align:left;height: 30px'>________________________</td>
                         <td style='width:45%;text-align:left;height: 30px'>________________________</td>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                     </tr>
                      <tr>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                         <td style='width:45%;text-align:left;height: 30px'>Firma Supervisor</td>
                         <td style='width:45%;text-align:left;height: 30px'>Firma Contratista</td>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                     </tr>
                   
                    </table> 
                <br><br>";




            $numero_poliza = $numero_poliza . $polizas[$i]['numero_poliza'] . "<br>";
            $aseguradoras = $aseguradoras . $polizas[$i]['nombre_aseguradora'] . "<br>";
            $cadenaSql = $this->miSql->getCadenaSql('obtenerAmparosActivos', $polizas[$i]['id_poliza']);
            $amparosPoliza = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
            if ($amparosPoliza) {
                $amparos = array_merge($amparos, $amparosPoliza);
            }
        }



        $cadenaSql = $this->miSql->getCadenaSql('Consultar_Info_Suscripcion', $datosContrato);
        $infoSuscripcion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $infoSuscripcion = $infoSuscripcion[0];

        $cadenaSql = $this->miSql->getCadenaSql('Consultar_Contrato_Particular', $datosContrato);
        $contrato = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $contrato = $contrato[0];

        $lugarEjecucion = $contrato['lugar_ejecucion'];

        $cadenaSql = $this->miSql->getCadenaSql('consultaLugarEjecucion', $lugarEjecucion);
        $direccionEjecucion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");



        $cadenaSql = $this->miSql->getCadenaSql('ConsultarDescripcionParametro', $contrato['tipologia_contrato']);
        $tipoContrato = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('ConsultarTipoContrato', $contrato['tipo_contrato']);
        $tipoContrato = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('obtenerInfoProveedor', $contrato['contratista']);
        $contratista = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");
        $contratista = $contratista[0];


        $cadenaSql = $this->miSql->getCadenaSql('consultaTipoDocumento', $contratista ['num_documento']);
        $tipoDocumento = $esteRecursoDBAgora->ejecutarAcceso($cadenaSql, "busqueda");

        $InfoContratista = strtoupper($contratista['nom_proveedor']) . ", mayor de edad, identificado con " . $tipoDocumento[0][0] . " No. " . $contratista['num_documento'] . " expedida en " . $tipoDocumento[0][1];
        $InfoContratistaFirma = $tipoDocumento[0][0] . ": " . $contratista['num_documento'];


        if ($contratista['tipopersona'] = "NATURAL") {
            $info_contratista_nombre = $contratista['nom_proveedor'];
            $info_contratista_documento = $contratista['num_documento'];
            $contratista = $contratista['nom_proveedor'] . "<br><b> DOCUMENTO: " . $contratista['num_documento'] . "</b>";
        } else {
            $info_contratista_nombre = $contratista['nom_proveedor'];
            $info_contratista_documento = $contratista['num_documento'];
            $contratista = $contratista['nom_proveedor'] . "<br><b> NIT: " . $contratista['num_documento'] . "</b>";
        }

        $funcionLetras = new EnLetras ();

        $Letras = $funcionLetras->ValorEnLetras($contrato['valor_contrato'], ' Pesos ');

        $valorContrato = $Letras . "($" . number_format($contrato['valor_contrato'], 2, ",", ".") . ")";


        if ($contrato ['unidad_ejecucion'] == '205') {
            $meses = $contrato['plazo_ejecucion'] / 30;
            if ($meses > 1) {
                $meses = floor($meses);
                $parcial = $meses * 30;
                $dias = $contrato['plazo_ejecucion'] - $parcial;
                $plazo = $meses . " mes(es) y " . $dias . " dia(s) ";
            } else {
                $plazo = $contrato['plazo_ejecucion'] . " dia(s) ";
            }
        } elseif ($contrato ['unidad_ejecucion'] == '206') {
            $plazo = $contrato['plazo_ejecucion'] . " Mes(es) ";
        } else {
            $meses = $contrato['plazo_ejecucion'] * 12;
            $plazo = $meses . " mes(es) ";
        }


        $plazoEjecucion = $plazo;

        $fechaSucripcion = explode("-", $infoSuscripcion['fecha_suscripcion']);
        setlocale(LC_TIME, "es_ES.UTF-8");

        $fechaSucripcion = strftime("%A, %d de %B de %Y", gmmktime(12, 0, 0, $fechaSucripcion[1], $fechaSucripcion[2], $fechaSucripcion[0]));


        $sqlfechaMaximaAprobacion = $this->miSql->getCadenaSql('obtenerFechaAprobacionMaximaPolizasActivas', $datosContrato);
        $fechaMaximaAprobacion = $esteRecursoDB->ejecutarAcceso($sqlfechaMaximaAprobacion, "busqueda");

        if ($fechaMaximaAprobacion == false || $fechaMaximaAprobacion[0][0] == null) {

            $fechaMaximaAprobacion = "(NO APLICA - MIENTRAS NO EXISTAN POLIZAS REGISTRADAS)";
        } else {

            $fechaMaximaAprobacion = explode("-", $fechaMaximaAprobacion[0]['fecha_aprobacion']);
            $fechaMaximaAprobacion = strftime("%A, %d de %B de %Y", gmmktime(12, 0, 0, $fechaMaximaAprobacion[1], $fechaMaximaAprobacion[2], $fechaMaximaAprobacion[0]));
        }

        $cadenaMinimoVigente = $this->miSql->getCadenaSql("obtenerMinimoVigente", date("Y"));
        $minimoVigente = $esteRecursoDB->ejecutarAcceso($cadenaMinimoVigente, "busqueda");


        $fechaAprobacionpoliza = explode("-", $polizas[0]['fecha_aprobacion']);
        setlocale(LC_TIME, "es_ES.UTF-8");

        $fechaAprobacionpoliza = strftime("%A, %d de %B de %Y", gmmktime(12, 0, 0, $fechaAprobacionpoliza[1], $fechaAprobacionpoliza[2], $fechaAprobacionpoliza[0]));

        $fechaExpedicionpoliza = explode("-", $polizas[0]['fecha_expedicion']);
        setlocale(LC_TIME, "es_ES.UTF-8");

        $fechaExpedicionpoliza = strftime("%A, %d de %B de %Y", gmmktime(12, 0, 0, $fechaExpedicionpoliza[1], $fechaExpedicionpoliza[2], $fechaExpedicionpoliza[0]));


        if (is_numeric($_REQUEST['tamanoletra']) && $_REQUEST['tamanoletra'] != null) {
            $letra = $_REQUEST['tamanoletra'];
        } else {
            $letra = 10;
        }


        $id_usuario = $_REQUEST['usuario'];

        $cadena_buscada = 'CC';

        $posicion_coincidencia = strrpos($id_usuario, $cadena_buscada);

        if ($posicion_coincidencia === false) {
            $supervisor = $_REQUEST['usuario'];
        } else {
            $cadenaSqlUnidad = $this->miSql->getCadenaSql("obtenerInfoUsuario", $id_usuario);
            $unidadEjecutora = $DBFrameWork->ejecutarAcceso($cadenaSqlUnidad, "busqueda");

            $supervisor = $unidadEjecutora[0]['identificacion'];
        }




        $val_fallo = '';


        $cadenaSql = $this->miSql->getCadenaSql('consultarInformacionSupervisor', $supervisor);
        $info_supervisor = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        $cadenaSql = $this->miSql->getCadenaSql('consultarLugarExpSiCapital', $info_supervisor[0]['documento']);
        $lugar_exp = $DBSICA->ejecutarAcceso($cadenaSql, "busqueda");

       

        $InfoSupervisor = strtoupper($info_supervisor[0]['nombre']) . ", mayor de edad, identificado con CÉDULA DE CIUDADANÍA No. " . $info_supervisor[0]['documento'] . " expedida en " . $lugar_exp[0][0];

        $InfoSupervisorFirma = " CÉDULA DE CIUDADANÍA " . $info_supervisor[0]['documento'];



        $contenidoPagina = "
<style type=\"text/css\">
    table.main { 
        color:#333; /* Lighten up font color */
        font-family:Helvetica, Arial, sans-serif; /* Nicer font */
	border: 0.5px solid black;	
        
    }
    
    td {
        background: #FAFAFA; /* Lighter grey background */
        text-align: left;
        font-size:" . $letra . "px
    }
   
    table.mainamparo { 
        border-collapse: collapse;
        border: 1px solid black;
        
    }
    td.mainamparo { 
         border: 1px solid black;
        
    }

   col{
	width=50%;
	
	}			
				
    th {
        background: #F3F3F3; /* Light grey background */
        font-weight: bold; /* Make sure they're bold */
        text-align: center;
        font-size:" . $letra . "px
    }

    
    td.main1 {
        border: 0.5px solid black;
        border-bottom: 0px;
        border-right: 0px;
        border-top: 0px;
    }
    td.main2 {
        border: 0.5px solid black;
        border-bottom: 0px;
        border-left: 0px;
        border-top: 0px;
    }
    td.main3 {
        border: 0.5px solid black;
        border-left: 0px;
        border-top: 0px;
        border-right: 0px;
        height='100'

    }
    td.main4 {
        border: 0.5px solid black;
        border-left: 0px;
        border-top: 0px;
        border-bottom: 0px;
    }
    td.main5 {
        border: 0.5px solid black;
        border-left: 0px;
        border-top: 0px;
        border-bottom: 0px;
        border-right: 0px;
    }
</style>				
				
				
<page backtop='5mm' backbottom='5mm' backleft='10mm' backright='10mm'>
	

        <table class='main' align='center' style='width:100%;' >
           
            <tr>
                <td class='main2' style='width:20%;text-align:center;' >
                    <img src='" . $directorio . "/css/images/escudoud.png'  width='100' height='100'>
                </td>
                <td class='main4' style='width:30%;text-align:justify;' >
                    <table align='center' style='width:100%;' >
                        <tr>
                            <td class='main3' style='width:100%;text-align:center;height: 30px;' >
                                 <font size='5px'>ACTA DE DE INICIO DE CONTRATO CPS</font>
                            </td>
                        </tr>
                        <tr>
                            <td class='main3' style='width:100%;text-align:center;height: 30px;' >
                                <font size='5px'>Macroproceso: Gestión Administrativa y Contratación</font>
                            </td>
                        </tr>    
                        <tr>
                            <td class='main5' style='width:100%;text-align:center;height: 30px;' >
                                 <font size='5px'>Proceso: Gestión Jurídica</font>
                            </td>
                        </tr>
                       
                    </table>
                </td>
                <td   style='width:25%;text-align:justify;' >
                   <table align='center' style='width:100%;' >
                        <tr>
                            <td class='main3' style='width:100%;text-align:justify;height: 30px' >
                                 <font size='3px'>Código: GJ-PR-001-FR-004</font>
                            </td>
                        </tr>
                        <tr>
                            <td class='main3' style='width:100%;text-align:justify;height: 30px' >
                                <font size='3px'>Versión: 04</font>
                            </td>
                        </tr>    
                        <tr>
                            <td class='main5' style='width:100%;text-align:justify;height: 30px' >
                                 <font size='3px'>Fecha de Aprobación: 21/10/16</font>
                            </td>
                        </tr>
                       
                    </table>
                </td>
                <td class='main1' style='width:25%;text-align:center;' >
                    <img src='" . $directorio . "/css/images/sigud.jpg'  width='100' height='100'>
                </td>
                                          
            </tr>
           
        </table><br><br>";


        $contenidoPagina .= "
            
                       
                


                <table align='justify' style='width:100%;' >                   
                     <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>CONTRATO No.</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'><b>" . $consecutivo_unico_contrato[0]['numero_contrato_suscrito'] . '</b>  suscrito el '.  $fechaSucripcion . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	 
                    </tr>
                    <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height:30px'><font size='3px'><b>OBJETO</b></font></td>	
                        <td class= 'objeto' style='width:55%;text-align:justify;height: 30px'><font size='1px'>" . $contrato['objeto_contrato'] . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                     <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>VALOR</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>" . $valorContrato . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                    <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>CONTRATISTA</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>$InfoContratista</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                    <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>PLAZO</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>" . $plazoEjecucion . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                     <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>FECHA DE INICIO.</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>" . 'Día: ' . $fecha_inicio_dia . ' Mes: ' . $fecha_inicio_mes . ' Año: ' . $fecha_inicio_ano . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                    <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>FECHA DE TERMINACIÓN.</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>" . 'Día: ' . $fecha_fin_dia . ' Mes: ' . $fecha_fin_mes . ' Año: ' . $fecha_fin_ano . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                     <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>SUPERVISOR UNIVERSIDAD <br>DISTRITAL FRANCISCO JOSÉ DE CALDAS</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'> " . $info_cargo_supervisor[0]['cargo'] . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                   <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>No. PÓLIZA</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>" . $numero_poliza . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                       <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>FECHA DE EXPEDICIÓN DE PÓLIZA</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>" . $fechaExpedicionpoliza . "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                    <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                        <td style='width:35%;text-align:justify;height: 30px'><font size='3px'><b>FECHA DE APROBACIÓN DE PÓLIZA.</b></font></td>	
                        <td style='width:55%;text-align:justify;height: 30px'><font size='3px'>" . $fechaAprobacionpoliza. "</font></td>	
                        <td style='width:5%;text-align:left;height: 30px'></td>	
                    </tr>
                    
               
                </table>";



        if (date('Y-m-d') <= $actas_inicio[0]['fecha_inicio']) {

            $fecha_final = date('Y-m-d');
            $fecha_final_dia = date('d', strtotime($fecha_final));
            $fecha_final_mes = date('m', strtotime($fecha_final));
            $fecha_final_ano = date('Y', strtotime($fecha_final));
        } else {
            $fecha_final = explode("-", $actas_inicio[0]['fecha_fin']);
            $fecha_final_dia = $fecha_final[2];
            $fecha_final_mes = $fecha_final[1];
            $fecha_final_ano = $fecha_final[0];
        }

        $funcionFechaLetras = new EnLetras ();




        $contenidoPagina .=

                "<br><br><table align='justify' style='width:100%;' >                   
                     <tr>
                        <td style='width:5%;text-align:left;height: 30px'></td> 
                        <td style='width:90%;text-align:justify;height: 60px'>En " . $direccionEjecucion[0]['nombre_ciudad'] . "  a los " . $funcionFechaLetras->Fecha_Dias($fecha_inicio_dia) . " (" . $fecha_inicio_dia . ") días del mes "
                . "de " . $funcionFechaLetras->Fecha_Mes($fecha_inicio_mes) . " del año " . $fecha_inicio_ano . "   , se reunieron: " . $InfoContratista . " quien ejerce como Contratista . y " . $InfoSupervisor . " en calidad
                            de Supervisor del Contrato por parte de la Universidad Distrital Francisco José de Caldas con el objeto de dejar constancia del inicio real y efectivo del Contrato anteriormente citado, previo cumplimiento
                            de los requisitos de legalización del Contrato. En consecuencia, se procede a la iniciación del Contrato a partir del día " . $funcionFechaLetras->Fecha_Dias($fecha_inicio_dia) . " (" . $fecha_inicio_dia . ") del "
                . "         mes de " . $funcionFechaLetras->Fecha_Mes($fecha_inicio_mes) . " del año " . $fecha_inicio_ano . ". El Supervisor puso en conocimiento del Contratista lo siguiente: 1. Que para la firma de la presente Acta de 
                            Iniciación, el Contratista ha presentado y reposa en la respectiva Carpeta, toda la documentación exigida por la Universidad para estos casos. 2. Que para el desarrollo del Contrato es indispensable mantener
                            la Propuesta de Servicios elaborada y cualquier modificación debe convenirse entre las partes. 3. Que en todo momento debe acatarse las instrucciones o exigencias que presente la Supervisión en lo 
                            referente a los Procesos y Procedimientos de la Dependencia.</td>   
                        <td style='width:5%;text-align:left;height: 30px'></td> 
                    </tr>
                    </table>
                    
                  <br><br>";        

        $contenidoPagina .= "  <table align='justify' style='width:100%;' >  
                     <tr>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                         <td style='width:90%;text-align:justify;height: 60px'> Para constancia de lo anterior, se firma la presente Acta bajo la responsabilidad expresa de los que intervienen en ella: </td>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                     </tr>
                   
                    </table>  
                    
                    <table align='justify' style='width:100%;' >  
                     <tr>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                         <td style='width:45%;text-align:left;height: 30px'>________________________<br><b>Supervisor</b><br>" . $info_supervisor[0]['nombre'] . "<br>" . $InfoSupervisorFirma . "</td>
                         <td style='width:45%;text-align:left;height: 30px'>________________________<br><b>Contratista</b><br>" . $info_contratista_nombre . "<br>" . $InfoContratistaFirma . "</td>
                         <td style='width:5%;text-align:left;height: 30px'></td>
                     </tr>
                  
                    </table> </page> ";





        return $contenidoPagina;
    }

}

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);

$textos = $miRegistrador->documento();
ob_start();
$html2pdf = new \HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8');
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->WriteHTML($textos);

$html2pdf->Output("Acta de Inicio" . '.pdf', 'D');
?>





