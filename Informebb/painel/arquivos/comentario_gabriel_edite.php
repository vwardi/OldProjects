<?php require_once('../../Connections/saquabb.php'); ?>
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

$MM_restrictGoTo = "../index.php";
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
?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the required classes
require_once('../../includes/tfi/TFI.php');
require_once('../../includes/tso/TSO.php');
require_once('../../includes/nav/NAV.php');

// Make unified connection variable
$conn_saquabb = new KT_connection($saquabb, $database_saquabb);

// Filter
$tfi_listcomentarios_gf2 = new TFI_TableFilter($conn_saquabb, "tfi_listcomentarios_gf2");
$tfi_listcomentarios_gf2->addColumn("comentarios_gf.id_coment", "NUMERIC_TYPE", "id_coment", "=");
$tfi_listcomentarios_gf2->addColumn("comentarios_gf.nome", "STRING_TYPE", "nome", "%");
$tfi_listcomentarios_gf2->addColumn("comentarios_gf.id", "NUMERIC_TYPE", "id", "=");
$tfi_listcomentarios_gf2->addColumn("comentarios_gf.aprovado", "CHECKBOX_YN_TYPE", "aprovado", "%");
$tfi_listcomentarios_gf2->Execute();

// Sorter
$tso_listcomentarios_gf2 = new TSO_TableSorter("rscomentarios_gf1", "tso_listcomentarios_gf2");
$tso_listcomentarios_gf2->addColumn("comentarios_gf.id_coment");
$tso_listcomentarios_gf2->addColumn("comentarios_gf.nome");
$tso_listcomentarios_gf2->addColumn("comentarios_gf.id");
$tso_listcomentarios_gf2->addColumn("comentarios_gf.aprovado");
$tso_listcomentarios_gf2->setDefault("comentarios_gf.nome DESC");
$tso_listcomentarios_gf2->Execute();

// Navigation
$nav_listcomentarios_gf2 = new NAV_Regular("nav_listcomentarios_gf2", "rscomentarios_gf1", "../../", $_SERVER['PHP_SELF'], 10);

//NeXTenesio3 Special List Recordset
$maxRows_rscomentarios_gf1 = $_SESSION['max_rows_nav_listcomentarios_gf2'];
$pageNum_rscomentarios_gf1 = 0;
if (isset($_GET['pageNum_rscomentarios_gf1'])) {
  $pageNum_rscomentarios_gf1 = $_GET['pageNum_rscomentarios_gf1'];
}
$startRow_rscomentarios_gf1 = $pageNum_rscomentarios_gf1 * $maxRows_rscomentarios_gf1;

$NXTFilter_rscomentarios_gf1 = "1=1";
if (isset($_SESSION['filter_tfi_listcomentarios_gf2'])) {
  $NXTFilter_rscomentarios_gf1 = $_SESSION['filter_tfi_listcomentarios_gf2'];
}
$NXTSort_rscomentarios_gf1 = "comentarios_gf.nome DESC";
if (isset($_SESSION['sorter_tso_listcomentarios_gf2'])) {
  $NXTSort_rscomentarios_gf1 = $_SESSION['sorter_tso_listcomentarios_gf2'];
}
mysql_select_db($database_saquabb, $saquabb);

$query_rscomentarios_gf1 = sprintf("SELECT comentarios_gf.id_coment, comentarios_gf.nome, comentarios_gf.id, comentarios_gf.aprovado FROM comentarios_gf WHERE %s ORDER BY %s", $NXTFilter_rscomentarios_gf1, $NXTSort_rscomentarios_gf1);
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

$nav_listcomentarios_gf2->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/controle.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>:: Painel de controle Saquabb ::</title>
<!-- InstanceEndEditable -->
<link href="../../css.css" rel="stylesheet" type="text/css" />
<link href="painel.css" rel="stylesheet" type="text/css" />
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
  .KT_col_id_coment {width:140px; overflow:hidden;}
  .KT_col_nome {width:140px; overflow:hidden;}
  .KT_col_id {width:140px; overflow:hidden;}
  .KT_col_aprovado {width:140px; overflow:hidden;}
</style>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="800" border="1" align="center" cellpadding="4" cellspacing="8" bordercolor="#EA8C06" bgcolor="#FFFFFF">
  <tr>
    <th height="61" colspan="2" bgcolor="#FFFFFF" scope="col"><img src="../banner.jpg" width="775" height="120" /></th>
  </tr>
  <tr>
    <th width="152" align="center" valign="top" bgcolor="#FFFFFF" scope="row"><table width="152" border="1" cellpadding="2" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#EA8C06" id="navigation">
      
      <tr>
        <th width="144" height="30" align="center" valign="middle" bgcolor="#EA8C06" scope="row"><a href="../home.php">Home</a></th>
      </tr>
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">Foto Destaque </span></th>
      </tr>
      <tr>
        <th scope="row"><a href="foto_destaque_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="foto_destaque_edite.php">Editar / Excluir </a></th>
      </tr>
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">Not&iacute;cia</span></th>
      </tr>
      <tr>
        <th scope="row"><a href="not_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="not_edite.php">Editar / Excluir </a></th>
      </tr>
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">Categoria </span></th>
      </tr>
      <tr>
        <th scope="row"><a href="secao_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="secao_edite.php">Editar / Excluir </a></th>
      </tr>
      
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">Foto</span></th>
      </tr>
      <tr>
        <th scope="row"><a href="foto_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="foto_edite.php">Editar / Excluir </a></th>
      </tr>
      
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">Galeria</span></th>
      </tr>
      <tr>
        <th scope="row"><a href="galeria_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="galeria_edite.php">Editar / Excluir </a></th>
      </tr>
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">V&iacute;deos</span></th>
      </tr>
      <tr>
        <th scope="row"><a href="video_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="video_edite.php">Editar / Excluir </a></th>
      </tr>
      
      
      
      
      
      
      

      
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">Perfil</span></th>
      </tr>
      <tr>
        <th scope="row"><a href="perfil_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="perfil_edite.php">Editar / Excluir</a> </th>
      </tr>
      
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><span class="style1">Coment&aacute;rios</span></th>
      </tr>
      
      <tr>
        <th scope="row"><a href="comentario_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="comentario_edite.php">Editar / Excluir </a></th>
      </tr>
      
      <tr>
        <th height="30" align="center" valign="middle" bgcolor="#7FA14D" scope="row"><p class="style1">Uu&aacute;rios</p></th>
      </tr>
      <tr>
        <th scope="row"><a href="user_add.php">Adicionar</a></th>
      </tr>
      <tr>
        <th scope="row"><a href="user_edite.php">Editar / Excluir </a></th>
      </tr>
      
      <tr>
        <th height="30" bgcolor="#7FA14D" scope="row"><span class="style1">Logout</span></th>
      </tr>
      <tr>
        <th class="Titulo_galeria" scope="row"><a href="http://www.saquabb.com.br" class="Titulo_galeria">Sair</a></th>
      </tr>
      <tr>
        <th bgcolor="#7FA14D" scope="row">&nbsp;</th>
      </tr>
      
      
    </table></th>
    <td width="608" align="center" valign="top" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="conteudo" -->
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <th align="left" valign="middle" bgcolor="#EA8C06" class="Titulo_Branco" scope="col">Coment&aacute;rio Gabriel </th>
        </tr>
        <tr>
          <th align="left" valign="top" scope="row"><div class="KT_tng" id="listcomentarios_gf2"><div class="KT_tnglist"><form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1"><div class="KT_options">
            <?php 
  // Show IF Conditional region2
  if (@$_SESSION['has_filter_tfi_listcomentarios_gf2'] == 1) {
?>
                              <a href="<?php echo $tfi_listcomentarios_gf2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                              <?php 
  // else Conditional region2
  } else { ?>
                              <a href="<?php echo $tfi_listcomentarios_gf2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                              <?php } 
  // endif Conditional region2
?>
                  </div>
                  <table border="1" cellpadding="2" cellspacing="0" bordercolor="#EA8C06" class="KT_tngtable">
                    <thead>
                      <tr class="KT_row_order">
                        <th align="center" bgcolor="#EA8C06"> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>                        </th>
                        <th align="center" bgcolor="#EA8C06" class="KT_sorter KT_col_nome <?php echo $tso_listcomentarios_gf2->getSortIcon('comentarios_gf.nome'); ?>" id="nome"> <a href="<?php echo $tso_listcomentarios_gf2->getSortLink('comentarios_gf.nome'); ?>">Nome</a> </th>
                        <th align="center" bgcolor="#EA8C06" class="KT_sorter KT_col_id <?php echo $tso_listcomentarios_gf2->getSortIcon('comentarios_gf.id'); ?>" id="id"> <a href="<?php echo $tso_listcomentarios_gf2->getSortLink('comentarios_gf.id'); ?>">Id</a> </th>
                        <th align="center" bgcolor="#EA8C06" class="KT_sorter KT_col_aprovado <?php echo $tso_listcomentarios_gf2->getSortIcon('comentarios_gf.aprovado'); ?>" id="aprovado"> <a href="<?php echo $tso_listcomentarios_gf2->getSortLink('comentarios_gf.aprovado'); ?>">Aprovado</a> </th>
                        <th align="center" bgcolor="#EA8C06">&nbsp;</th>
                      </tr>
                      <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcomentarios_gf2'] == 1) {
?>
                        <tr class="KT_row_filter">
                          <td>&nbsp;</td>
                          <td><input type="text" name="tfi_listcomentarios_gf2_nome" id="tfi_listcomentarios_gf2_nome" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcomentarios_gf2_nome']); ?>" size="20" maxlength="50" /></td>
                          <td><input type="text" name="tfi_listcomentarios_gf2_id" id="tfi_listcomentarios_gf2_id" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcomentarios_gf2_id']); ?>" size="20" maxlength="100" /></td>
                          <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listcomentarios_gf2_aprovado']),"Y"))) {echo "checked";} ?> type="checkbox" name="tfi_listcomentarios_gf2_aprovado" id="tfi_listcomentarios_gf2_aprovado" value="Y" /></td>
                          <td><input type="submit" name="tfi_listcomentarios_gf2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
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
                                <input type="hidden" name="id_coment" class="id_field" value="<?php echo $row_rscomentarios_gf1['id_coment']; ?>" />                            </td>
                            <td><div class="KT_col_nome"><?php echo KT_FormatForList($row_rscomentarios_gf1['nome'], 20); ?></div></td>
                            <td><div class="KT_col_id"><?php echo KT_FormatForList($row_rscomentarios_gf1['id'], 20); ?></div></td>
                            <td><div class="KT_col_aprovado"><?php echo KT_FormatForList($row_rscomentarios_gf1['aprovado'], 20); ?></div></td>
                            <td><a class="KT_edit_link" href="comentario_gabriel_add.php?id_coment=<?php echo $row_rscomentarios_gf1['id_coment']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                          </tr>
                          <?php } while ($row_rscomentarios_gf1 = mysql_fetch_assoc($rscomentarios_gf1)); ?>
                        <?php } // Show if recordset not empty ?>
                    </tbody>
                  </table>
                  <div class="KT_bottomnav">
                    <div>
                      <?php
            $nav_listcomentarios_gf2->Prepare();
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
                    <a class="KT_additem_op_link" href="comentario_gabriel_add.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
                </form>
              </div>
              <br class="clearfixplain" />
            </div>
          <p>&nbsp;</p></th>
        </tr>
      </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <th height="40" colspan="2" bgcolor="#EA8C06" class="Titulo_Branco" scope="row">Painel Administrativo desenvolvido por: Victor Caetano </th>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rscomentarios_gf1);
?>