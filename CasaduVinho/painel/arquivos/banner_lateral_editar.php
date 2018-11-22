<?php require_once('../../Connections/ConBD.php'); ?>
<?php require_once('log.php'); ?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

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
$tfi_listbanner_lateral1 = new TFI_TableFilter($conn_ConBD, "tfi_listbanner_lateral1");
$tfi_listbanner_lateral1->addColumn("banner_lateral.id", "NUMERIC_TYPE", "id", "=");
$tfi_listbanner_lateral1->addColumn("banner_lateral.imagem", "NUMERIC_TYPE", "imagem", "=");
$tfi_listbanner_lateral1->addColumn("banner_lateral.link", "STRING_TYPE", "link", "%");
$tfi_listbanner_lateral1->Execute();

// Sorter
$tso_listbanner_lateral1 = new TSO_TableSorter("rsbanner_lateral1", "tso_listbanner_lateral1");
$tso_listbanner_lateral1->addColumn("banner_lateral.id");
$tso_listbanner_lateral1->addColumn("banner_lateral.imagem");
$tso_listbanner_lateral1->addColumn("banner_lateral.link");
$tso_listbanner_lateral1->setDefault("banner_lateral.id DESC");
$tso_listbanner_lateral1->Execute();

// Navigation
$nav_listbanner_lateral1 = new NAV_Regular("nav_listbanner_lateral1", "rsbanner_lateral1", "../../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rsbanner_lateral1 = $_SESSION['max_rows_nav_listbanner_lateral1'];
$pageNum_rsbanner_lateral1 = 0;
if (isset($_GET['pageNum_rsbanner_lateral1'])) {
  $pageNum_rsbanner_lateral1 = $_GET['pageNum_rsbanner_lateral1'];
}
$startRow_rsbanner_lateral1 = $pageNum_rsbanner_lateral1 * $maxRows_rsbanner_lateral1;

// Defining List Recordset variable
$NXTFilter_rsbanner_lateral1 = "1=1";
if (isset($_SESSION['filter_tfi_listbanner_lateral1'])) {
  $NXTFilter_rsbanner_lateral1 = $_SESSION['filter_tfi_listbanner_lateral1'];
}
// Defining List Recordset variable
$NXTSort_rsbanner_lateral1 = "banner_lateral.id DESC";
if (isset($_SESSION['sorter_tso_listbanner_lateral1'])) {
  $NXTSort_rsbanner_lateral1 = $_SESSION['sorter_tso_listbanner_lateral1'];
}
mysql_select_db($database_ConBD, $ConBD);

$query_rsbanner_lateral1 = "SELECT banner_lateral.id, banner_lateral.imagem, banner_lateral.link FROM banner_lateral WHERE {$NXTFilter_rsbanner_lateral1} ORDER BY {$NXTSort_rsbanner_lateral1}";
$query_limit_rsbanner_lateral1 = sprintf("%s LIMIT %d, %d", $query_rsbanner_lateral1, $startRow_rsbanner_lateral1, $maxRows_rsbanner_lateral1);
$rsbanner_lateral1 = mysql_query($query_limit_rsbanner_lateral1, $ConBD) or die(mysql_error());
$row_rsbanner_lateral1 = mysql_fetch_assoc($rsbanner_lateral1);

if (isset($_GET['totalRows_rsbanner_lateral1'])) {
  $totalRows_rsbanner_lateral1 = $_GET['totalRows_rsbanner_lateral1'];
} else {
  $all_rsbanner_lateral1 = mysql_query($query_rsbanner_lateral1);
  $totalRows_rsbanner_lateral1 = mysql_num_rows($all_rsbanner_lateral1);
}
$totalPages_rsbanner_lateral1 = ceil($totalRows_rsbanner_lateral1/$maxRows_rsbanner_lateral1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listbanner_lateral1->checkBoundries();

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("../../", "KT_thumbnail1");
$objDynamicThumb1->setFolder("../../Uploads/");
$objDynamicThumb1->setRenameRule("{rsbanner_lateral1.imagem}");
$objDynamicThumb1->setResize(50, 0, true);
$objDynamicThumb1->setWatermark(false);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/painel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Painel Administrativo </title>
<!-- InstanceEndEditable -->
<link href="css.css" rel="stylesheet" type="text/css" />
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
  duplicate_navigation: false,
  row_effects: false,
  show_as_buttons: true,
  record_counter: false
}
</script>
<style type="text/css">
  /* Dynamic List row settings */
  .KT_col_id {width:140px; overflow:hidden;}
  .KT_col_imagem {width:140px; overflow:hidden;}
  .KT_col_link {width:140px; overflow:hidden;}
</style>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	background-image: url(../../img/fundo.jpg);
	background-color: #28370E;
}
.style6 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
-->
</style>
<link href="../../css/painel.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="750" border="1" align="center" cellpadding="1" cellspacing="4" bordercolor="#CCCCCC" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2" background="../img/base.jpg"><img src="../img/topo.jpg" alt="Painel Administrativo" width="600" height="80" /></td>
  </tr>
  <tr>
    <td width="180" align="center" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left" valign="middle" class="titulomenu">Menu</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="titulo">Produtos</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="produtos_inserir.php">Inserir</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="produtos_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="titulo">Pa&iacute;s</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="pais_inserir.php">Inserir</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="pais_editar.php">Editar/Excluir</a></td>
      </tr>
      
      
      <tr>
        <td align="left" valign="middle" class="titulo">Banner Topo</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="banner_cima_inserir.php">Adicionar</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="banner_cima_editar.php">Editar/Excluir</a></td>
      </tr>
      
      <tr>
        <td align="left" valign="middle" class="titulo">Banner Lateral</td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="banner_lateral_inserir.php">Adicionar</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" class="link"><a href="banner_lateral_editar.php">Editar/Excluir</a></td>
      </tr>
      

      
      <tr>
        <td align="left" valign="middle" class="titulomenu">Logout</td>
      </tr>
      <tr>
        <td align="left" valign="middle"><a href="<?php echo $logoutAction ?>" class="link style6">Sair</a></td>
      </tr>
      
    </table></td>
    <td width="619" align="center" valign="top"><!-- InstanceBeginEditable name="conteudo" -->
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td align="left" valign="top" class="titulo">Editar Banner Lateral</td>
        </tr>
        <tr>
          <td height="19" align="center" valign="top"><br />
            <div class="KT_tng" id="listbanner_lateral1">
              <div class="KT_tnglist">
                <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
                  <div class="KT_options"> <a href="<?php echo $nav_listbanner_lateral1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                    <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listbanner_lateral1'] == 1) {
?>
                      <?php echo $_SESSION['default_max_rows_nav_listbanner_lateral1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listbanner_lateral1'] == 1) {
?>
                  <a href="<?php echo $tfi_listbanner_lateral1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listbanner_lateral1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
                  </div>
                  <table cellpadding="2" cellspacing="0" class="borda_cinza" id="painel">
                    <thead>
                      <tr class="KT_row_order">
                        <th align="center" bgcolor="#CCCCCC" class="fonte"> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>                        </th>
                        <th align="center" bgcolor="#CCCCCC" class="fonte" id="imagem"> <a href="<?php echo $tso_listbanner_lateral1->getSortLink('banner_lateral.imagem'); ?>">Imagem</a> </th>
                        <th align="center" bgcolor="#CCCCCC" class="fonte" id="link"> <a href="<?php echo $tso_listbanner_lateral1->getSortLink('banner_lateral.link'); ?>">Link</a> </th>
                        <th align="center" bgcolor="#CCCCCC" class="fonte">&nbsp;</th>
                      </tr>
                      <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listbanner_lateral1'] == 1) {
?>
                        <tr class="KT_row_filter">
                          <td>&nbsp;</td>
                          <td><input type="text" name="tfi_listbanner_lateral1_imagem" id="tfi_listbanner_lateral1_imagem" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listbanner_lateral1_imagem']); ?>" size="20" maxlength="100" /></td>
                          <td><input type="text" name="tfi_listbanner_lateral1_link" id="tfi_listbanner_lateral1_link" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listbanner_lateral1_link']); ?>" size="20" maxlength="200" /></td>
                          <td><input type="submit" name="tfi_listbanner_lateral1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                        </tr>
                        <?php } 
  // endif Conditional region3
?>
                    </thead>
                    <tbody>
                      <?php if ($totalRows_rsbanner_lateral1 == 0) { // Show if recordset empty ?>
                        <tr>
                          <td colspan="4"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                        </tr>
                        <?php } // Show if recordset empty ?>
                      <?php if ($totalRows_rsbanner_lateral1 > 0) { // Show if recordset not empty ?>
                        <?php do { ?>
                          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                            <td><input type="checkbox" name="kt_pk_banner_lateral" class="id_checkbox" value="<?php echo $row_rsbanner_lateral1['id']; ?>" />
                                <input type="hidden" name="id" class="id_field" value="<?php echo $row_rsbanner_lateral1['id']; ?>" />                            </td>
                            <td><img src="<?php echo $objDynamicThumb1->Execute(); ?>" border="0" /></td>
                            <td><div class="KT_col_link"><?php echo KT_FormatForList($row_rsbanner_lateral1['link'], 20); ?></div></td>
                            <td><a class="KT_edit_link" href="banner_lateral_inserir.php?id=<?php echo $row_rsbanner_lateral1['id']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                          </tr>
                          <?php } while ($row_rsbanner_lateral1 = mysql_fetch_assoc($rsbanner_lateral1)); ?>
                        <?php } // Show if recordset not empty ?>
                    </tbody>
                  </table>
                  <div class="KT_bottomnav">
                    <div>
                      <?php
            $nav_listbanner_lateral1->Prepare();
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
                    <a class="KT_additem_op_link" href="banner_lateral_inserir.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
    <td height="40" colspan="2" align="center" valign="middle" background="../img/base.jpg" bgcolor="#2B90BA"><span class="txt_branco">Painel Administrativo desenvolvido por: <span class="fonte"><span class="txt_branco"><strong>Victor Caetano</strong></span></span></span></td>
  </tr>
</table>
</body><!-- InstanceEnd --></html>
<?php
mysql_free_result($rsbanner_lateral1);
?>
