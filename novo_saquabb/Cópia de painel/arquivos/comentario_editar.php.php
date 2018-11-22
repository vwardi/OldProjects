<?php require_once('../../Connections/saquabb.php'); ?><?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the required classes
require_once('../../includes/tfi/TFI.php');
require_once('../../includes/tso/TSO.php');
require_once('../../includes/nav/NAV.php');

// Make unified connection variable
$conn_saquabb = new KT_connection($saquabb, $database_saquabb);

// Filter
$tfi_listcomentarios_gf1 = new TFI_TableFilter($conn_saquabb, "tfi_listcomentarios_gf1");
$tfi_listcomentarios_gf1->addColumn("comentarios_gf.nome", "STRING_TYPE", "nome", "%");
$tfi_listcomentarios_gf1->addColumn("comentarios_gf.mail", "STRING_TYPE", "mail", "%");
$tfi_listcomentarios_gf1->addColumn("comentarios_gf.cidade", "STRING_TYPE", "cidade", "%");
$tfi_listcomentarios_gf1->addColumn("comentarios_gf.comentario", "STRING_TYPE", "comentario", "%");
$tfi_listcomentarios_gf1->addColumn("comentarios_gf.id", "NUMERIC_TYPE", "id", "=");
$tfi_listcomentarios_gf1->addColumn("comentarios_gf.aprovado", "STRING_TYPE", "aprovado", "%");
$tfi_listcomentarios_gf1->Execute();

// Sorter
$tso_listcomentarios_gf1 = new TSO_TableSorter("rscomentarios_gf1", "tso_listcomentarios_gf1");
$tso_listcomentarios_gf1->addColumn("comentarios_gf.nome");
$tso_listcomentarios_gf1->addColumn("comentarios_gf.mail");
$tso_listcomentarios_gf1->addColumn("comentarios_gf.cidade");
$tso_listcomentarios_gf1->addColumn("comentarios_gf.comentario");
$tso_listcomentarios_gf1->addColumn("comentarios_gf.id");
$tso_listcomentarios_gf1->addColumn("comentarios_gf.aprovado");
$tso_listcomentarios_gf1->setDefault("comentarios_gf.nome DESC");
$tso_listcomentarios_gf1->Execute();

// Navigation
$nav_listcomentarios_gf1 = new NAV_Regular("nav_listcomentarios_gf1", "rscomentarios_gf1", "../../", $_SERVER['PHP_SELF'], 10);

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

//NeXTenesio3 Special List Recordset
$maxRows_rscomentarios_gf1 = $_SESSION['max_rows_nav_listcomentarios_gf1'];
$pageNum_rscomentarios_gf1 = 0;
if (isset($_GET['pageNum_rscomentarios_gf1'])) {
  $pageNum_rscomentarios_gf1 = $_GET['pageNum_rscomentarios_gf1'];
}
$startRow_rscomentarios_gf1 = $pageNum_rscomentarios_gf1 * $maxRows_rscomentarios_gf1;

$NXTFilter_rscomentarios_gf1 = "1=1";
if (isset($_SESSION['filter_tfi_listcomentarios_gf1'])) {
  $NXTFilter_rscomentarios_gf1 = $_SESSION['filter_tfi_listcomentarios_gf1'];
}
$NXTSort_rscomentarios_gf1 = "comentarios_gf.nome DESC";
if (isset($_SESSION['sorter_tso_listcomentarios_gf1'])) {
  $NXTSort_rscomentarios_gf1 = $_SESSION['sorter_tso_listcomentarios_gf1'];
}
mysql_select_db($database_saquabb, $saquabb);

$query_rscomentarios_gf1 = sprintf("SELECT comentarios_gf.nome, comentarios_gf.mail, comentarios_gf.cidade, comentarios_gf.comentario, comentarios_gf.id, comentarios_gf.aprovado, comentarios_gf.id_coment FROM comentarios_gf WHERE %s ORDER BY %s", $NXTFilter_rscomentarios_gf1, $NXTSort_rscomentarios_gf1);
$query_limit_rscomentarios_gf1 = sprintf("%s LIMIT %d, %d", $query_rscomentarios_gf1, $startRow_rscomentarios_gf1, $maxRows_rscomentarios_gf1);
$rscomentarios_gf1 = mysql_query($query_limit_rscomentarios_gf1, $saquabb) or die(mysql_error());
$row_rscomentarios_gf1 = mysql_fetch_assoc($rscomentarios_gf1);

if (isset($_GET['totalRows_rscomentarios_gf1'])) {
  $totalRows_rscomentarios_gf1 = $_GET['totalRows_rscomentarios_gf1'];
} else {
  $all_rscomentarios_gf1 = mysql_query($query_rscomentarios_gf1);
  $totalRows_rscomentarios_gf1 = mysql_num_rows($all_rscomentarios_gf1);
}
$totalPages_rscomentarios_gf1 = ceil($totalRows_rscomentarios_gf1/$maxRows_rscomentarios_gf1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcomentarios_gf1->checkBoundries();
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
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
<script src="../../includes/nxt/scripts/list.js" type="text/javascript"></script>
<script src="../../includes/nxt/scripts/list.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: false,
  duplicate_navigation: true,
  row_effects: false,
  show_as_buttons: true,
  record_counter: false
}
</script>
<style type="text/css">
  /* NeXTensio3 List row settings */
  .KT_col_nome {width:140px; overflow:hidden;}
  .KT_col_mail {width:140px; overflow:hidden;}
  .KT_col_cidade {width:140px; overflow:hidden;}
  .KT_col_comentario {width:140px; overflow:hidden;}
  .KT_col_id {width:140px; overflow:hidden;}
  .KT_col_aprovado {width:140px; overflow:hidden;}
.style1 {color: #FFCC33}
</style>
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
              <td height="32"><!-- InstanceBeginEditable name="conteudo" -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top">&nbsp;
                      <div class="KT_tng" id="listcomentarios_gf1">
                        <h1> Comentarios_gf
                          <?php
  $nav_listcomentarios_gf1->Prepare();
  require("../../includes/nav/NAV_Text_Statistics.inc.php");
?>
                        </h1>
                        <div class="KT_tnglist">
                          <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
                            <div class="KT_options"> <a href="<?php echo $nav_listcomentarios_gf1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                              <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcomentarios_gf1'] == 1) {
?>
                                <?php echo $_SESSION['default_max_rows_nav_listcomentarios_gf1']; ?>
                                <?php 
  // else Conditional region1
  } else { ?>
                                <?php echo NXT_getResource("all"); ?>
                                <?php } 
  // endif Conditional region1
?>
                                  <?php echo NXT_getResource("records"); ?></a> &nbsp;
                              &nbsp;
                            <?php 
  // Show IF Conditional region2
  if (@$_SESSION['has_filter_tfi_listcomentarios_gf1'] == 1) {
?>
                              <a href="<?php echo $tfi_listcomentarios_gf1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                              <?php 
  // else Conditional region2
  } else { ?>
                              <a href="<?php echo $tfi_listcomentarios_gf1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                              <?php } 
  // endif Conditional region2
?>
                            </div>
                            <table cellpadding="2" cellspacing="0" class="KT_tngtable" id="tabela">
                              <thead>
                                <tr class="KT_row_order">
                                  <th bgcolor="#FFCC33"> <input name="KT_selAll" type="checkbox" id="KT_selAll"/>                                  </th>
                                  <th bgcolor="#FFCC33" class="KT_sorter KT_col_nome <?php echo $tso_listcomentarios_gf1->getSortIcon('comentarios_gf.nome'); ?>" id="nome"> <a href="<?php echo $tso_listcomentarios_gf1->getSortLink('comentarios_gf.nome'); ?>" class="style1">Nome</a> </th>
                                  <th bgcolor="#FFCC33" class="KT_sorter KT_col_cidade <?php echo $tso_listcomentarios_gf1->getSortIcon('comentarios_gf.cidade'); ?>" id="cidade"> <a href="<?php echo $tso_listcomentarios_gf1->getSortLink('comentarios_gf.cidade'); ?>" class="style1">Cidade</a> </th>
                                  <th bgcolor="#FFCC33" class="KT_sorter KT_col_aprovado <?php echo $tso_listcomentarios_gf1->getSortIcon('comentarios_gf.aprovado'); ?>" id="aprovado"> <a href="<?php echo $tso_listcomentarios_gf1->getSortLink('comentarios_gf.aprovado'); ?>" class="style1">Aprovado</a> </th>
                                  <th bgcolor="#FFCC33"><span class="style1"></span></th>
                                </tr>
                                <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcomentarios_gf1'] == 1) {
?>
                                  <tr class="KT_row_filter">
                                    <td>&nbsp;</td>
                                    <td><input type="text" name="tfi_listcomentarios_gf1_nome" id="tfi_listcomentarios_gf1_nome" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcomentarios_gf1_nome']); ?>" size="20" maxlength="50" /></td>
                                    <td><input type="text" name="tfi_listcomentarios_gf1_cidade" id="tfi_listcomentarios_gf1_cidade" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcomentarios_gf1_cidade']); ?>" size="20" maxlength="50" /></td>
                                    <td><input type="text" name="tfi_listcomentarios_gf1_aprovado" id="tfi_listcomentarios_gf1_aprovado" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcomentarios_gf1_aprovado']); ?>" size="20" maxlength="20" /></td>
                                    <td><input type="submit" name="tfi_listcomentarios_gf1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                                  </tr>
                                  <?php } 
  // endif Conditional region3
?>
                              </thead>
                              <tbody>
                                <?php if ($totalRows_rscomentarios_gf1 == 0) { // Show if recordset empty ?>
                                  <tr>
                                    <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                                  </tr>
                                  <?php } // Show if recordset empty ?>
                                <?php if ($totalRows_rscomentarios_gf1 > 0) { // Show if recordset not empty ?>
                                  <?php do { ?>
                                    <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                                      <td><input type="checkbox" name="kt_pk_comentarios_gf" class="id_checkbox" value="<?php echo $row_rscomentarios_gf1['id_coment']; ?>" />
                                          <input type="hidden" name="id_coment" class="id_field" value="<?php echo $row_rscomentarios_gf1['id_coment']; ?>" />
                                      </td>
                                      <td><div class="KT_col_nome"><?php echo KT_FormatForList($row_rscomentarios_gf1['nome'], 20); ?></div></td>
                                      <td><div class="KT_col_cidade"><?php echo KT_FormatForList($row_rscomentarios_gf1['cidade'], 20); ?></div></td>
                                      <td><div class="KT_col_aprovado"><?php echo KT_FormatForList($row_rscomentarios_gf1['aprovado'], 20); ?></div></td>
                                      <td><a class="KT_edit_link" href="comentario_add.php?id_coment=<?php echo $row_rscomentarios_gf1['id_coment']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                                    </tr>
                                    <?php } while ($row_rscomentarios_gf1 = mysql_fetch_assoc($rscomentarios_gf1)); ?>
                                  <?php } // Show if recordset not empty ?>
                              </tbody>
                            </table>
                            <div class="KT_bottomnav">
                              <div>
                                <?php
            $nav_listcomentarios_gf1->Prepare();
            require("../../includes/nav/NAV_Text_Navigation.inc.php");
          ?>
                              </div>
                            </div>
                            <div class="KT_bottombuttons">
                              <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onclick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource("edit_all"); ?></a> <a class="KT_delete_op_link" href="#" onclick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource("delete_all"); ?></a> </div>
                              <span>&nbsp;</span>
                              <select name="no_new" id="no_new">
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="6">6</option>
                              </select>
                              <a class="KT_additem_op_link" href="comentario_add.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
                          </form>
                        </div>
                        <br class="clearfixplain" />
                      </div>
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

mysql_free_result($rscomentarios_gf1);
?>
