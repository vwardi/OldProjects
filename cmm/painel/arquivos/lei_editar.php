<?php require_once('../../Connections/ConBD.php'); ?><?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the required classes
require_once('../../includes/tfi/TFI.php');
require_once('../../includes/tso/TSO.php');
require_once('../../includes/nav/NAV.php');

// Make unified connection variable
$conn_ConBD = new KT_connection($ConBD, $database_ConBD);

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// Filter
$tfi_listlei1 = new TFI_TableFilter($conn_ConBD, "tfi_listlei1");
$tfi_listlei1->addColumn("lei.leiID", "NUMERIC_TYPE", "leiID", "=");
$tfi_listlei1->addColumn("lei.numero", "STRING_TYPE", "numero", "%");
$tfi_listlei1->addColumn("lei.descricao", "STRING_TYPE", "descricao", "%");
$tfi_listlei1->addColumn("lei.data", "STRING_TYPE", "data", "%");
$tfi_listlei1->Execute();

// Sorter
$tso_listlei1 = new TSO_TableSorter("rslei1", "tso_listlei1");
$tso_listlei1->addColumn("lei.leiID");
$tso_listlei1->addColumn("lei.numero");
$tso_listlei1->addColumn("lei.descricao");
$tso_listlei1->addColumn("lei.data");
$tso_listlei1->setDefault("lei.leiID DESC");
$tso_listlei1->Execute();

// Navigation
$nav_listlei1 = new NAV_Regular("nav_listlei1", "rslei1", "../../", $_SERVER['PHP_SELF'], 20);

//NeXTenesio3 Special List Recordset
$maxRows_rslei1 = $_SESSION['max_rows_nav_listlei1'];
$pageNum_rslei1 = 0;
if (isset($_GET['pageNum_rslei1'])) {
  $pageNum_rslei1 = $_GET['pageNum_rslei1'];
}
$startRow_rslei1 = $pageNum_rslei1 * $maxRows_rslei1;

// Defining List Recordset variable
$NXTFilter_rslei1 = "1=1";
if (isset($_SESSION['filter_tfi_listlei1'])) {
  $NXTFilter_rslei1 = $_SESSION['filter_tfi_listlei1'];
}
// Defining List Recordset variable
$NXTSort_rslei1 = "lei.leiID DESC";
if (isset($_SESSION['sorter_tso_listlei1'])) {
  $NXTSort_rslei1 = $_SESSION['sorter_tso_listlei1'];
}
mysql_select_db($database_ConBD, $ConBD);

$query_rslei1 = "SELECT lei.leiID, lei.numero, lei.descricao, lei.data FROM lei WHERE {$NXTFilter_rslei1} ORDER BY {$NXTSort_rslei1}";
$query_limit_rslei1 = sprintf("%s LIMIT %d, %d", $query_rslei1, $startRow_rslei1, $maxRows_rslei1);
$rslei1 = mysql_query($query_limit_rslei1, $ConBD) or die(mysql_error());
$row_rslei1 = mysql_fetch_assoc($rslei1);

if (isset($_GET['totalRows_rslei1'])) {
  $totalRows_rslei1 = $_GET['totalRows_rslei1'];
} else {
  $all_rslei1 = mysql_query($query_rslei1);
  $totalRows_rslei1 = mysql_num_rows($all_rslei1);
}
$totalPages_rslei1 = ceil($totalRows_rslei1/$maxRows_rslei1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listlei1->checkBoundries();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/painel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Painel Administrativo </title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEditableHeadTag -->

<!-- InstanceEndEditable -->
<link href="../css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
	color: #75CCF0;
}
-->
</style>
<link href="../../css/estilo_isc.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body,td,th {
	color: #666666;
}
body {
	background-color: #ECEFF4;
}
-->
</style></head>

<body>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="8" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2" bgcolor="#657D99"><table width="100%" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td width="5%" height="87"><a href="../../index.php"><img src="../../img/logo_02.jpg" width="73" height="79" border="0" /></a></td>
        <td width="95%" align="right"><img src="TOPO.jpg" width="650" height="79" /></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td width="242" align="left" valign="top" bgcolor="#FEDDA5"><table width="250" height="100%" border="0" cellpadding="4" cellspacing="0">
      <tr>
        <td height="20" bgcolor="#657D99"><img src="../../img/titulo_menu_01.gif" width="62" height="12" class="titulo" /></td>
      </tr>
      <tr>
        <td bgcolor="#FEDDA5">&nbsp;</td>
      </tr>
      <tr>
        <td class="titulo">Not&iacute;cias</td>
      </tr>
      <tr>
        <td class="txt_06"><a href="noticia_inserir.php" class="txt_06">Inserir  </a></td>
      </tr>
      <tr>
        <td class="txt_06"><a href="noticia_editar.php" class="txt_06">Editar/Excluir </a></td>
      </tr>
      
      <tr>
        <td class="titulo">Galeria de Fotos</td>
      </tr>
      <tr>
        <td><a href="galeria_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="galeria_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Fotos</td>
      </tr>
      <tr>
        <td><a href="foto_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="foto_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Galeria Conhe&ccedil;a a C&acirc;mara</td>
      </tr>
      <tr>
        <td><a href="camara_inserir.php">Inserir Foto</a></td>
      </tr>
      <tr>
        <td><a href="camara_editar.php">Editar/Excluir</a></td>
      </tr>
      
      <tr>
        <td class="titulo">Lei</td>
      </tr>
      <tr>
        <td><a href="lei_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="lei_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Indica&ccedil;&atilde;o</td>
      </tr>
      <tr>
        <td><a href="inscricao_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="inscricao_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Licita&ccedil;&atilde;o</td>
      </tr>
      <tr>
        <td><a href="licitacao_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="licitacao_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Vereador</td>
      </tr>
      <tr>
        <td><a href="vereador_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="vereador_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Comiss&otilde;es</td>
      </tr>
      <tr>
        <td><a href="comissoes_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="comissoes_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Mesa Diretora</td>
      </tr>
      
      <tr>
        <td><a href="mesa_inserir.php?MesaID=1">Editar</a></td>
      </tr>
      
      <tr>
        <td bgcolor="#657D99" class="titulo">Logout</td>
      </tr>
      <tr>
        <td><a href="<?php echo $logoutAction ?>">Sair</a></td>
      </tr>
      

    </table></td>
    <td width="600" align="left" valign="top"><!-- InstanceBeginEditable name="conteudo" -->
      <link href="../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
      <script src="../../includes/common/js/base.js" type="text/javascript"></script>
      <script src="../../includes/common/js/utility.js" type="text/javascript"></script>
      <script src="../../includes/skins/style.js" type="text/javascript"></script>
      <script src="../../includes/nxt/scripts/list.js" type="text/javascript"></script>
      <script src="../../includes/nxt/scripts/list.js.php" type="text/javascript"></script>
      <script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: false,
  duplicate_navigation: false,
  row_effects: false,
  show_as_buttons: true,
  record_counter: false
}
      </script>
      <style type="text/css">
  /* Dynamic List row settings */
  .KT_col_leiID {width:140px; overflow:hidden;}
  .KT_col_numero {width:40px; overflow:hidden;}
  .KT_col_descricao {width:180px; overflow:hidden;}
  .KT_col_data {width:70px; overflow:hidden;}
      </style>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="titulo"><p>Lei</p>
          </td>
        </tr>
        <tr>
          <td>&nbsp;
            <div class="KT_tng" id="listlei1">
              <h1><span class="text"> Lei
                <?php
  $nav_listlei1->Prepare();
  require("../../includes/nav/NAV_Text_Statistics.inc.php");
?>
                </span></h1>
              <div class="KT_tnglist">
                <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
                  <div class="KT_options"> <a href="<?php echo $nav_listlei1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                    <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listlei1'] == 1) {
?>
                      <?php echo $_SESSION['default_max_rows_nav_listlei1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listlei1'] == 1) {
?>
                      <a href="<?php echo $tfi_listlei1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                      <?php 
  // else Conditional region2
  } else { ?>
                      <a href="<?php echo $tfi_listlei1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                      <?php } 
  // endif Conditional region2
?>
                  </div>
                  <table cellpadding="2" cellspacing="0" class="borda_roxa" id="painel">
                    <thead>
                      <tr class="KT_row_order">
                        <th bgcolor="#FEDDA5"> <div align="center">
                          <input type="checkbox" name="KT_selAll" id="KT_selAll"/>                        
                        </div></th>
                        <th bgcolor="#FEDDA5" class="KT_sorter KT_col_numero <?php echo $tso_listlei1->getSortIcon('lei.numero'); ?>" id="numero"> <div align="center"><a href="<?php echo $tso_listlei1->getSortLink('lei.numero'); ?>">N�mero</a> </div></th>
                        <th bgcolor="#FEDDA5" class="KT_sorter KT_col_descricao <?php echo $tso_listlei1->getSortIcon('lei.descricao'); ?>" id="descricao"> <div align="center"><a href="<?php echo $tso_listlei1->getSortLink('lei.descricao'); ?>">Descri��o</a> </div></th>
                        <th bgcolor="#FEDDA5" class="KT_sorter KT_col_data <?php echo $tso_listlei1->getSortIcon('lei.data'); ?>" id="data"> <div align="center"><a href="<?php echo $tso_listlei1->getSortLink('lei.data'); ?>">Data</a> </div></th>
                        <th bgcolor="#FEDDA5"><div align="center"></div></th>
                      </tr>
                      <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listlei1'] == 1) {
?>
                        <tr class="KT_row_filter">
                          <td>&nbsp;</td>
                          <td><input type="text" name="tfi_listlei1_numero" id="tfi_listlei1_numero" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listlei1_numero']); ?>" size="20" maxlength="50" /></td>
                          <td><input type="text" name="tfi_listlei1_descricao" id="tfi_listlei1_descricao" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listlei1_descricao']); ?>" size="50" maxlength="100" /></td>
                          <td><input type="text" name="tfi_listlei1_data" id="tfi_listlei1_data" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listlei1_data']); ?>" size="20" maxlength="150" /></td>
                          <td><input type="submit" name="tfi_listlei1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                        </tr>
                        <?php } 
  // endif Conditional region3
?>
                    </thead>
                    <tbody>
                      <?php if ($totalRows_rslei1 == 0) { // Show if recordset empty ?>
                        <tr>
                          <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                        </tr>
                        <?php } // Show if recordset empty ?>
                      <?php if ($totalRows_rslei1 > 0) { // Show if recordset not empty ?>
                        <?php do { ?>
                          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                            <td><input type="checkbox" name="kt_pk_lei" class="id_checkbox" value="<?php echo $row_rslei1['leiID']; ?>" />
                                <input type="hidden" name="leiID" class="id_field" value="<?php echo $row_rslei1['leiID']; ?>" />                            </td>
                            <td><div class="KT_col_numero"><?php echo KT_FormatForList($row_rslei1['numero'], 20); ?></div></td>
                            <td><div class="KT_col_descricao"><?php echo KT_FormatForList($row_rslei1['descricao'], 50); ?></div></td>
                            <td><div class="KT_col_data"><?php echo KT_FormatForList($row_rslei1['data'], 20); ?></div></td>
                            <td><a class="KT_edit_link" href="lei_inserir.php?leiID=<?php echo $row_rslei1['leiID']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                          </tr>
                          <?php } while ($row_rslei1 = mysql_fetch_assoc($rslei1)); ?>
                        <?php } // Show if recordset not empty ?>
                    </tbody>
                  </table>
                  <div class="KT_bottomnav">
                    <div>
                      <?php
            $nav_listlei1->Prepare();
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
                    <a class="KT_additem_op_link" href="lei_inserir.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
                </form>
              </div>
              <br class="clearfixplain" />
            </div>
          <p>&nbsp;</p></td>
        </tr>
      </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#8C9EB4"><div align="center">
      <table width="730" border="0" cellspacing="0" cellpadding="0">
        <tr class="txt_01">
          <td><div align="left"><span class="txt_03">&copy; 2008 C&acirc;mara Municipal de Mangaratiba - Todos os direitos reservados.</span></div></td>
          <td height="25"><div align="right"><a href="http://www.lobsterdesigner.com.br/" target="_blank"><img src="../../img/logo_lobster_01.gif" width="83" height="23" border="0" /></a></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rslei1);
?>
