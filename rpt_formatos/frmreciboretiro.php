<?php
/**
 * @since 31/03/2008
 * @author Balam Gonzalez Luis Humberto
 * @version 1.0.1
 *  01/Abril/2008
 * 		- cambios en la fecha
 * 		- Agregar Documento de Destino
 */
//=====================================================================================================
//=====>	INICIO_H
	include_once("../core/go.login.inc.php");
	include_once("../core/core.error.inc.php");
	include_once("../core/core.html.inc.php");
	include_once("../core/core.init.inc.php");
	$theFile					= __FILE__;
	$permiso					= getSIPAKALPermissions($theFile);
	if($permiso === false){		header ("location:../404.php?i=999");	}
	$_SESSION["current_file"]	= addslashes( $theFile );
//<=====	FIN_H
	$iduser = $_SESSION["log_id"];
//=====================================================================================================
$xHP		= new cHPage("TR.Recibo de Egresos", HP_RECIBO);
$xRuls		= new cReglaDeNegocio();
$xUsr		= new cSystemUser();

$recibo		= parametro("idrecibo", 0, MQL_INT); $recibo		= parametro("r", $recibo, MQL_INT); $recibo		= parametro("recibo", $recibo, MQL_INT);
$formato	= parametro("forma", 400, MQL_INT);
$xHP->init();

$useAlt			= $xRuls->getValorPorRegla($xRuls->reglas()->RECIBOS_USE_TICKETS);
$useAltUser		= $xUsr->getPuedeUsarPrintPOS();

//================
if($formato == 400 AND ($useAlt == true OR $useAltUser == true) ){
	$formato	= 402;
}


$xFMT		= new cHFormatoRecibo($recibo, $formato);
echo $xFMT->render();
$xHP->fin();
?>