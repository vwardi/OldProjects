<?php require_once('../../Connections/ConBD.php'); ?>
<?php require_once('log.php'); ?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the required classes
require_once('../../includes/tfi/TFI.php');
require_once('../../includes/tso/TSO.php');
require_once('../../includes/nav/NAV.php');

// Make unified connection variable
$conn_ConBD = new KT_connection($ConBD, $database_ConBD);

// Filter
$tfi_listnovidades1 = new TFI_TableFilter($conn_ConBD, "tfi_listnovidades1");
$tfi_listnovidades1->addColumn("novidades.id", "NUMERIC_TYPE", "id", "=");
$tfi_listnovidades1->addColumn("novidades.titulo", "STRING_TYPE", "titulo", "%");
$tfi_listnovidades1->addColumn("novidades.data", "STRING_TYPE", "data", "%");
$tfi_listnovidades1->addColumn("novidades.categoria", "STRING_TYPE", "categoria", "%");
$tfi_listnovidades1->Execute();

// Sorter
$tso_listnovidades1 = new TSO_TableSorter("rsnovidades1", "tso_listnovidades1");
$tso_listnovidades1->addColumn("novidades.id");
$tso_listnovidades1->addColumn("novidades.titulo");
$tso_listnovidades1->addColumn("novidades.data");
$tso_listnovidades1->addColumn("novidades.categoria");
$tso_listnovidades1->setDefault("novidades.id DESC");
$tso_listnovidades1->Execute();

// Navigation
$nav_listnovidades1 = new NAV_Regular("nav_listnovidades1", "rsnovidades1", "../../", $_SERVER['PHP_SELF'], 20);

//NeXTenesio3 Special List Recordset
$maxRows_rsnovidades1 = $_SESSION['max_rows_nav_listnovidades1'];
$pageNum_rsnovidades1 = 0;
if (isset($_GET['pageNum_rsnovidades1'])) {
  $pageNum_rsnovidades1 = $_GET['pageNum_rsnovidades1'];
}
$startRow_rsnovidades1 = $pageNum_rsnovidades1 * $maxRows_rsnovidades1;

$NXTFilter_rsnovidades1 = "1=1";
if (isset($_SESSION['filter_tfi_listnovidades1'])) {
  $NXTFilter_rsnovidades1 = $_SESSION['filter_tfi_listnovidades1'];
}
$NXTSort_rsnovidades1 = "novidades.id DESC";
if (isset($_SESSION['sorter_tso_listnovidades1'])) {
  $NXTSort_rsnovidades1 = $_SESSION['sorter_tso_listnovidades1'];
}
mysql_select_db($database_ConBD, $ConBD);

$query_rsnovidades1 = sprintf("SELECT novidades.id, novidades.titulo, novidades.data, novidades.categoria FROM novidades WHERE %s ORDER BY %s", $NXTFilter_rsnovidades1, $NXTSort_rsnovidades1);
$query_limit_rsnovidades1 = sprintf("%s LIMIT %d, %d", $query_rsnovidades1, $startRow_rsnovidades1, $maxRows_rsnovidades1);
$rsnovidades1 = mysql_query($query_limit_rsnovidades1, $ConBD) or die(mysql_error());
$row_rsnovidades1 = mysql_fetch_assoc($rsnovidades1);

if (isset($_GET['totalRows_rsnovidades1'])) {
  $totalRows_rsnovidades1 = $_GET['totalRows_rsnovidades1'];
} else {
  $all_rsnovidades1 = mysql_query($query_rsnovidades1);
  $totalRows_rsnovidades1 = mysql_num_rows($all_rsnovidades1);
}
$totalPages_rsnovidades1 = ceil($totalRows_rsnovidades1/$maxRows_rsnovidades1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listnovidades1->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
</head>

<body>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="4" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><img src="painel.jpg" alt="Painel Administrativo" width="850" height="80" /></td>
  </tr>
  <tr>
    <td width="242" align="left" valign="top" bgcolor="#EDE4EF"><table width="250" height="100%" border="0" cellpadding="4" cellspacing="0">
      <tr>
        <td><span class="style1">Menu</span></td>
      </tr>
      <tr>
        <td class="titulo">Lojas</td>
      </tr>
      <tr>
        <td class="txt_06"><a href="loja_inserir.php" class="txt_06">Inserir  </a></td>
      </tr>
      <tr>
        <td class="txt_06"><a href="loja_editar.php" class="txt_06">Editar/Excluir </a></td>
      </tr>
      
      <tr>
        <td class="titulo">Categoria de Lojas </td>
      </tr>
      <tr>
        <td><a href="categoria_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="categoria_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Novidades</td>
      </tr>
      <tr>
        <td><a href="novidade_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="novidade_editar.php">Editar/Excluir</a></td>
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
        <td class="titulo">Categoria de Novidades</td>
      </tr>
      <tr>
        <td><a href="categoria_novidade_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td><a href="categoria_novidade_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Enquete</td>
      </tr>
      <tr>
        <td><a href="enquete_titulo_add.php?ID=1">Editar titulo da Enquete </a></td>
      </tr>
      <tr>
        <td><a href="enquete_opcoes_inserir.php">Inserir Op&ccedil;&otilde;es </a></td>
      </tr>
      
      <tr>
        <td><a href="enquete_opcoes_editar.php">Editar/Excluir Op&ccedil;&otilde;es </a></td>
      </tr>
      <tr>
        <td class="titulo">Logout</td>
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
  /* NeXTensio3 List row settings */
  .KT_col_id {width:140px; overflow:hidden;}
  .KT_col_titulo {width:140px; overflow:hidden;}
  .KT_col_data {width:140px; overflow:hidden;}
  .KT_col_categoria {width:140px; overflow:hidden;}
      </style>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="titulo">Editar/Excluir</td>
        </tr>
        <tr>
          <td>&nbsp;Novidades
            <?php
  $nav_listnovidades1->Prepare();
  require("../../includes/nav/NAV_Text_Statistics.inc.php");
?>
            <div class="KT_tng" id="listnovidades1">
                <div class="KT_tnglist">
                <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
                  <div class="KT_options"> <a href="<?php echo $nav_listnovidades1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                    <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listnovidades1'] == 1) {
?>
                      <?php echo $_SESSION['default_max_rows_nav_listnovidades1']; ?>
                      <?php 
  // else Conditional region1
  } else { ?>
                      <?php echo NXT_getResource("all"); ?>
                      <?php } 
  // endif Conditional region1
?>
                        <?php echo NXT_getResource("records"); ?></a> &nbsp;
                  &nbsp; </div>
                  <table cellpadding="2" cellspacing="0" class="borda_roxa" id="painel">
                    <thead>
                      <tr class="KT_row_order">
                        <th width="24" bgcolor="#EDE4EF"> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>                        </th>
                        <th width="119" align="center" bgcolor="#EDE4EF" class="KT_sorter KT_col_titulo <?php echo $tso_listnovidades1->getSortIcon('novidades.titulo'); ?>" id="titulo"> <a href="<?php echo $tso_listnovidades1->getSortLink('novidades.titulo'); ?>">Titulo</a> </th>
                        <th width="116" align="center" bgcolor="#EDE4EF" class="KT_sorter KT_col_data <?php echo $tso_listnovidades1->getSortIcon('novidades.data'); ?>" id="data"> <a href="<?php echo $tso_listnovidades1->getSortLink('novidades.data'); ?>">Data</a> </th>
                        <th width="142" align="center" bgcolor="#EDE4EF" class="KT_sorter KT_col_categoria <?php echo $tso_listnovidades1->getSortIcon('novidades.categoria'); ?>" id="categoria"> <a href="<?php echo $tso_listnovidades1->getSortLink('novidades.categoria'); ?>">Categoria</a> </th>
                        <th width="62" bgcolor="#EDE4EF">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($totalRows_rsnovidades1 == 0) { // Show if recordset empty ?>
                        <tr>
                          <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                        </tr>
                        <?php } // Show if recordset empty ?>
                      <?php if ($totalRows_rsnovidades1 > 0) { // Show if recordset not empty ?>
                        <?php do { ?>
                          <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                            <td><input type="checkbox" name="kt_pk_novidades" class="id_checkbox" value="<?php echo $row_rsnovidades1['id']; ?>" />
                                <input type="hidden" name="id" class="id_field" value="<?php echo $row_rsnovidades1['id']; ?>" />                            </td>
                            <td class="txt_06"><div class="KT_col_titulo"><?php echo KT_FormatForList($row_rsnovidades1['titulo'], 20); ?></div></td>
                            <td class="txt_06"><div class="KT_col_data"><?php echo KT_FormatForList($row_rsnovidades1['data'], 20); ?></div></td>
                            <td class="txt_06"><div class="KT_col_categoria"><?php echo KT_FormatForList($row_rsnovidades1['categoria'], 20); ?></div></td>
                            <td><a class="KT_edit_link" href="novidade_inserir.php?id=<?php echo $row_rsnovidades1['id']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                          </tr>
                          <?php } while ($row_rsnovidades1 = mysql_fetch_assoc($rsnovidades1)); ?>
                        <?php } // Show if recordset not empty ?>
                    </tbody>
                  </table>
                  <div class="KT_bottomnav">
                    <div>
                      <?php
            $nav_listnovidades1->Prepare();
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
                    <a class="KT_additem_op_link" href="novidade_inserir.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
    <td colspan="2"><img src="rodape.jpg" alt="Desenvolvido por: Lobster Designer" width="850" height="50" /></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsnovidades1);
?>
