<?php
$indice=0;
$estilo[$indice++]="ui.jqgrid.css";
$estilo[$indice++]="ui.multiselect.css";
$estilo[$indice++]="timepicker.css";
$estilo[$indice++]="jquery-te.css";
$estilo[$indice++]="validationEngine.jquery.css";
$estilo[$indice++]="autocomplete.css";
$estilo[$indice++]="chosen.css";
$estilo[$indice++]="select2.css";
$estilo[$indice++]="jquery_switch.css";
$estilo[$indice++]="jquery-ui_smoot.css";
$estilo[$indice++]="jquery-ui.css";
$estilo[$indice++]="estiloBloque.css";

// Tablas
$estilo[$indice++]="demo_page.css";
$estilo[$indice++]="demo_table.css";
$estilo[$indice++]="jquery.dataTables.css";
//$estilo[$indice++]="jquery.dataTables.min.css";
$estilo[$indice++]="jquery.dataTables_themeroller.css";
//$estilo[$indice++]="dataTables.tableTools.css";
//$estilo[$indice++]="dataTables.tableTools.min.css";

$rutaBloque=$this->miConfigurador->getVariableConfiguracion("host");
$rutaBloque.=$this->miConfigurador->getVariableConfiguracion("site");

if($unBloque["grupo"]==""){
	$rutaBloque.="/blocks/".$unBloque["nombre"];
}else{
	$rutaBloque.="/blocks/".$unBloque["grupo"]."/".$unBloque["nombre"];
}

foreach ($estilo as $nombre){
	echo "<link rel='stylesheet' type='text/css' href='".$rutaBloque."/css/".$nombre."'>\n";
}
?>
