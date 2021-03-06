<?php require_once('../../Connections/saquabb.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../erro.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?><?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../");

// Make unified connection variable
$conn_saquabb = new KT_connection($saquabb, $database_saquabb);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../../uploads/fotos/");
  $deleteObj->setDbFieldName("imagem");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("imagem");
  $uploadObj->setDbFieldName("imagem");
  $uploadObj->setFolder("../../uploads/fotos/");
  $uploadObj->setMaxSize(200);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

mysql_select_db($database_saquabb, $saquabb);
$query_noticias = "SELECT * FROM noticias ORDER BY id DESC";
$noticias = mysql_query($query_noticias, $saquabb) or die(mysql_error());
$row_noticias = mysql_fetch_assoc($noticias);
$totalRows_noticias = mysql_num_rows($noticias);

mysql_select_db($database_saquabb, $saquabb);
$query_fotos = "SELECT * FROM fotos ORDER BY id DESC";
$fotos = mysql_query($query_fotos, $saquabb) or die(mysql_error());
$row_fotos = mysql_fetch_assoc($fotos);
$totalRows_fotos = mysql_num_rows($fotos);

mysql_select_db($database_saquabb, $saquabb);
$query_perfil = "SELECT * FROM perfil";
$perfil = mysql_query($query_perfil, $saquabb) or die(mysql_error());
$row_perfil = mysql_fetch_assoc($perfil);
$totalRows_perfil = mysql_num_rows($perfil);

mysql_select_db($database_saquabb, $saquabb);
$query_perfil_Y = "SELECT * FROM perfil WHERE aprovado = 'y'";
$perfil_Y = mysql_query($query_perfil_Y, $saquabb) or die(mysql_error());
$row_perfil_Y = mysql_fetch_assoc($perfil_Y);
$totalRows_perfil_Y = mysql_num_rows($perfil_Y);

mysql_select_db($database_saquabb, $saquabb);
$query_perfil_n = "SELECT * FROM perfil WHERE aprovado = 'n'";
$perfil_n = mysql_query($query_perfil_n, $saquabb) or die(mysql_error());
$row_perfil_n = mysql_fetch_assoc($perfil_n);
$totalRows_perfil_n = mysql_num_rows($perfil_n);

mysql_select_db($database_saquabb, $saquabb);
$query_not_saquabb = "SELECT * FROM noticias WHERE coluna = 'saquabb'";
$not_saquabb = mysql_query($query_not_saquabb, $saquabb) or die(mysql_error());
$row_not_saquabb = mysql_fetch_assoc($not_saquabb);
$totalRows_not_saquabb = mysql_num_rows($not_saquabb);

mysql_select_db($database_saquabb, $saquabb);
$query_not_bblagos = "SELECT * FROM noticias WHERE coluna = 'bblagos'";
$not_bblagos = mysql_query($query_not_bblagos, $saquabb) or die(mysql_error());
$row_not_bblagos = mysql_fetch_assoc($not_bblagos);
$totalRows_not_bblagos = mysql_num_rows($not_bblagos);

mysql_select_db($database_saquabb, $saquabb);
$query_not_girls = "SELECT * FROM noticias WHERE coluna = 'girls'";
$not_girls = mysql_query($query_not_girls, $saquabb) or die(mysql_error());
$row_not_girls = mysql_fetch_assoc($not_girls);
$totalRows_not_girls = mysql_num_rows($not_girls);

mysql_select_db($database_saquabb, $saquabb);
$query_festas = "SELECT * FROM festas";
$festas = mysql_query($query_festas, $saquabb) or die(mysql_error());
$row_festas = mysql_fetch_assoc($festas);
$totalRows_festas = mysql_num_rows($festas);

mysql_select_db($database_saquabb, $saquabb);
$query_not_atual = "SELECT * FROM noticias WHERE coluna = 'atualidades'";
$not_atual = mysql_query($query_not_atual, $saquabb) or die(mysql_error());
$row_not_atual = mysql_fetch_assoc($not_atual);
$totalRows_not_atual = mysql_num_rows($not_atual);

// Make an insert transaction instance
$ins_festas = new tNG_multipleInsert($conn_saquabb);
$tNGs->addTransaction($ins_festas);
// Register triggers
$ins_festas->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_festas->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_festas->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$ins_festas->registerTrigger("AFTER", "Trigger_ImageUpload", 98);
// Add columns
$ins_festas->setTable("festas");
$ins_festas->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_festas->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_festas->addColumn("pasta", "STRING_TYPE", "POST", "pasta");
$ins_festas->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$ins_festas->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_festas = new tNG_multipleUpdate($conn_saquabb);
$tNGs->addTransaction($upd_festas);
// Register triggers
$upd_festas->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_festas->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_festas->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$upd_festas->registerTrigger("AFTER", "Trigger_ImageUpload", 98);
// Add columns
$upd_festas->setTable("festas");
$upd_festas->addColumn("nome", "STRING_TYPE", "POST", "nome");
$upd_festas->addColumn("data", "STRING_TYPE", "POST", "data");
$upd_festas->addColumn("pasta", "STRING_TYPE", "POST", "pasta");
$upd_festas->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$upd_festas->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_festas = new tNG_multipleDelete($conn_saquabb);
$tNGs->addTransaction($del_festas);
// Register triggers
$del_festas->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_festas->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$del_festas->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_festas->setTable("festas");
$del_festas->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsfestas = $tNGs->getRecordset("festas");
$row_rsfestas = mysql_fetch_assoc($rsfestas);
$totalRows_rsfestas = mysql_num_rows($rsfestas);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/painel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<!--templateinfo codeoutsidehtmlislocked="true"-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Painel de Controle</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../../painel/css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="../../java.js"></script>
<!--Script png transparente-->
<script language="JavaScript">
	function correctPNG() // correctly handle PNG transparency in Win IE 5.5 & 6.
	{
	   var arVersion = navigator.appVersion.split("MSIE")
	   var version = parseFloat(arVersion[1])
	   if ((version >= 5.5) && (document.body.filters)) 
	   {
		  for(var i=0; i<document.images.length; i++)
		  {
			 var img = document.images[i]
			 var imgName = img.src.toUpperCase()
			 if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
			 {
				var imgID = (img.id) ? "id='" + img.id + "' " : ""
				var imgClass = (img.className) ? "class='" + img.className + "' " : ""
				var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
				var imgStyle = "display:inline-block;" + img.style.cssText 
				if (img.align == "left") imgStyle = "float:left;" + imgStyle
				if (img.align == "right") imgStyle = "float:right;" + imgStyle
				if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
				var strNewHTML = "<span " + imgTitle
				+ " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
				+ "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
				+ "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
				img.outerHTML = strNewHTML
				i = i-1
			 }
		  }
	   }    
	}
	window.attachEvent("onload", correctPNG);
	</script>

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEditableHeadTag -->
<link href="../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
<link href="../../painel/arquivos/css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style></head>

<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" class="borda_tabela">
  <tr>
    <td height="57" colspan="2"><img src="../../painel/img/topo.jpg" alt="topo" width="770" height="100" border="0" usemap="#Map" class="borda_topo" /></td>
  </tr>
  <tr>
    <td width="552" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="borda_toda">
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="borda_baixo_estistica">
            <tr>
              <td height="15" align="left" valign="middle"><span class="fonte"><a href="../../painel/home.php" class="fonte">home</a> - <a href="javascript:history.go(-1);" class="fonte">voltar</a></span> <a href="javascript:history.go(-1);"></a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="32"><!-- InstanceBeginEditable name="conteudo" --><?php echo $tNGs->displayValidationRules();?>
                  <script src="../../includes/nxt/scripts/form.js" type="text/javascript"></script>
                  <script src="../../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
                  <script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: false,
  show_as_grid: true,
  merge_down_value: true
}
                  </script>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top">&nbsp;
                      <?php
	echo $tNGs->getErrorMsg();
?>
                      <div class="KT_tng"><h1 class="titulo"><?php 
// Show IF Conditional region1 
if (@$_GET['id'] == "") {
?>
                            <?php echo NXT_getResource("Insert_FH"); ?>
                            <?php 
// else Conditional region1
} else { ?>
                            <?php echo NXT_getResource("Update_FH"); ?>
                            <?php } 
// endif Conditional region1
?>
                          &aacute;lbum de festas </h1>
                        <div class="KT_tngform">
                          <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
                            <?php $cnt1 = 0; ?>
                            <?php do { ?>
                              <?php $cnt1++; ?>
                              <?php 
// Show IF Conditional region1 
if (@$totalRows_rsfestas > 1) {
?>
                                <h2 class="titulo"><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                                <?php } 
// endif Conditional region1
?>
                              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                                <tr>
                                  <td align="left" valign="top" class="KT_th"><label for="nome_<?php echo $cnt1; ?>">Nome:</label></td>
                                  <td align="left" valign="top"><input name="nome_<?php echo $cnt1; ?>" type="text" class="box" id="nome_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsfestas['nome']); ?>" size="32" maxlength="50" />
                                      <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("festas", "nome", $cnt1); ?> </td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="KT_th"><label for="data_<?php echo $cnt1; ?>">Data:</label></td>
                                  <td align="left" valign="top"><input name="data_<?php echo $cnt1; ?>" type="text" class="box" id="data_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsfestas['data']); ?>" size="20" maxlength="20" />
                                      <?php echo $tNGs->displayFieldHint("data");?> <?php echo $tNGs->displayFieldError("festas", "data", $cnt1); ?> </td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="KT_th"><label for="pasta_<?php echo $cnt1; ?>">Pasta:</label></td>
                                  <td align="left" valign="top"><input name="pasta_<?php echo $cnt1; ?>" type="text" class="box" id="pasta_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsfestas['pasta']); ?>" size="32" maxlength="50" />
                                      <?php echo $tNGs->displayFieldHint("pasta");?> <?php echo $tNGs->displayFieldError("festas", "pasta", $cnt1); ?> </td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top" class="KT_th"><label for="imagem_<?php echo $cnt1; ?>">Imagem:</label></td>
                                  <td align="left" valign="top"><input name="imagem_<?php echo $cnt1; ?>" type="file" class="box" id="imagem_<?php echo $cnt1; ?>" size="32" />
                                      <?php echo $tNGs->displayFieldError("festas", "imagem", $cnt1); ?> </td>
                                </tr>
                              </table>
                              <br />
                              <input type="hidden" name="kt_pk_festas_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsfestas['kt_pk_festas']); ?>" />
                              <?php } while ($row_rsfestas = mysql_fetch_assoc($rsfestas)); ?>
                            <div class="KT_bottombuttons">
                              <div>
                                <?php 
      // Show IF Conditional region1
      if (@$_GET['id'] == "") {
      ?>
                                  <input name="KT_Insert1" type="submit" class="box_confirma" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                                  <?php 
      // else Conditional region1
      } else { ?>
                                  <br />
                                  <div class="KT_operations">
                                    <input name="KT_Insert1" type="submit" class="box_confirma" onclick="nxt_form_insertasnew(this, 'id')" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" />
                                    <br />
                                  </div>
                                  <input name="KT_Update1" type="submit" class="box_confirma" value="<?php echo NXT_getResource("Update_FB"); ?>" />
                                  <input name="KT_Delete1" type="submit" class="box_confirma" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" value="<?php echo NXT_getResource("Delete_FB"); ?>" />
                                  <?php }
      // endif Conditional region1
      ?>
                                <input name="KT_Cancel1" type="button" class="box_confirma" onclick="return UNI_navigateCancel(event, '../../includes/nxt/back.php')" value="<?php echo NXT_getResource("Cancel_FB"); ?>" />
                              </div>
                            </div>
                          </form>
                        </div>
                        <br class="clearfixplain" />
                      </div>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p></td>
                  </tr>
                </table>
              <!-- InstanceEndEditable --></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="218" align="center" valign="top"><table width="100%" border="0" cellpadding="4" cellspacing="4" class="borda_estatistica">
      <tr>
        <td align="center" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="4" class="borda_baixo_estistica">
          <tr class="borda_estatistica">
            <td width="21%" align="center" valign="top"><img src="../../painel/img/estatisticas.gif" width="32" height="32" /></td>
            <td width="79%" align="left" valign="middle"><span class="fonte_negrito"> Estatisticas</span></td>
          </tr>
        </table>          </td>
        </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td height="20" class="estatisticas_titulo"><span class="estatisticas_titulo">Noticias</span></td>
          </tr>
          <tr>
            <td><span class="fonte_negrito">- Total: </span><span class="resultado_estatistica"><?php echo $totalRows_noticias ?> </span></td>
          </tr>
          <tr>
            <td><span class="fonte_negrito">- Saquabb: </span><span class="resultado_estatistica"><?php echo $totalRows_not_saquabb ?> </span></td>
          </tr>
          <tr>
            <td><span class="fonte_negrito">- BBlagos: </span><span class="resultado_estatistica"><?php echo $totalRows_not_bblagos ?> </span></td>
          </tr>
          <tr>
            <td class="fonte_negrito">- Girls: <span class="resultado_estatistica"><?php echo $totalRows_not_girls ?> </span></td>
          </tr>
          <tr>
            <td class="fonte_negrito">- Atualidades: <span class="resultado_estatistica"><?php echo $totalRows_not_atual ?> </span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><span class="fonte_negrito">Total de Fotos:  </span><span class="resultado_estatistica"><?php echo $totalRows_fotos ?></span></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td height="20" class="estatisticas_titulo">Perfil de Atletas </td>
            </tr>
            <tr>
              <td><span class="fonte_negrito">- Total: </span><span class="resultado_estatistica"><?php echo $totalRows_perfil ?></span></td>
            </tr>
            <tr>
              <td><span class="fonte_negrito">- Aprovados: </span><span class="resultado_estatistica"><?php echo $totalRows_perfil_Y ?></span></td>
            </tr>
            <tr>
              <td><span class="fonte_negrito">- Aguardando Aprova&ccedil;&atilde;o: </span><span class="resultado_estatistica"><?php echo $totalRows_perfil_n ?></span></td>
            </tr>
          </table>          </td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td height="20" class="estatisticas_titulo">&Aacute;lbuns de Festas </td>
          </tr>
          <tr>
            <td><span class="fonte_negrito">- Total: </span><span class="resultado_estatistica"><?php echo $totalRows_festas ?> </span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
      
    </table></td>
  </tr>
</table>

<map name="Map" id="Map">
<area shape="poly" coords="541,11,537,56,576,56,573,10" href="#" alt="Site Seguro!" />
<area shape="circle" coords="612,34,25" href="#" alt="Informa&ccedil;&otilde;es!" />
<area shape="circle" coords="727,33,27" href="#" alt="Sair do Painel de Controle!" />
<area shape="circle" coords="671,34,21" href="#" alt="Adicionar o Painel ao seus Favoritos!" />
</map></body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($noticias);

mysql_free_result($fotos);

mysql_free_result($perfil);

mysql_free_result($perfil_Y);

mysql_free_result($perfil_n);

mysql_free_result($not_saquabb);

mysql_free_result($not_bblagos);

mysql_free_result($not_girls);

mysql_free_result($festas);

mysql_free_result($not_atual);
?>
