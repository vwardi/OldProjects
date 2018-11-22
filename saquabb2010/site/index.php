<?php require_once('Connections/saquabb.php'); ?>
<?php
// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

$maxRows_RsGalerias = 5;
$pageNum_RsGalerias = 0;
if (isset($_GET['pageNum_RsGalerias'])) {
  $pageNum_RsGalerias = $_GET['pageNum_RsGalerias'];
}
$startRow_RsGalerias = $pageNum_RsGalerias * $maxRows_RsGalerias;

mysql_select_db($database_saquabb, $saquabb);
$query_RsGalerias = "SELECT * FROM galeria ORDER BY id DESC";
$query_limit_RsGalerias = sprintf("%s LIMIT %d, %d", $query_RsGalerias, $startRow_RsGalerias, $maxRows_RsGalerias);
$RsGalerias = mysql_query($query_limit_RsGalerias, $saquabb) or die(mysql_error());
$row_RsGalerias = mysql_fetch_assoc($RsGalerias);

if (isset($_GET['totalRows_RsGalerias'])) {
  $totalRows_RsGalerias = $_GET['totalRows_RsGalerias'];
} else {
  $all_RsGalerias = mysql_query($query_RsGalerias);
  $totalRows_RsGalerias = mysql_num_rows($all_RsGalerias);
}
$totalPages_RsGalerias = ceil($totalRows_RsGalerias/$maxRows_RsGalerias)-1;

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("", "KT_thumbnail1");
$objDynamicThumb1->setFolder("uploads/fotos/");
$objDynamicThumb1->setRenameRule("{RsGalerias.imagem}");
$objDynamicThumb1->setResize(40, 40, false);
$objDynamicThumb1->setWatermark(false);

// Show Dynamic Thumbnail
$objDynamicThumb2 = new tNG_DynamicThumbnail("", "KT_thumbnail2");
$objDynamicThumb2->setFolder("uploads/fotos/");
$objDynamicThumb2->setRenameRule("{RsNoticias.imagem}");
$objDynamicThumb2->setResize(440, 0, true);
$objDynamicThumb2->setWatermark(false);
$maxRows_RsNoticias = 10;
$pageNum_RsNoticias = 0;
if (isset($_GET['pageNum_RsNoticias'])) {
  $pageNum_RsNoticias = $_GET['pageNum_RsNoticias'];
}
$startRow_RsNoticias = $pageNum_RsNoticias * $maxRows_RsNoticias;

mysql_select_db($database_saquabb, $saquabb);
$query_RsNoticias = "SELECT * FROM noticias ORDER BY id ASC";
$query_limit_RsNoticias = sprintf("%s LIMIT %d, %d", $query_RsNoticias, $startRow_RsNoticias, $maxRows_RsNoticias);
$RsNoticias = mysql_query($query_limit_RsNoticias, $saquabb) or die(mysql_error());
$row_RsNoticias = mysql_fetch_assoc($RsNoticias);

if (isset($_GET['totalRows_RsNoticias'])) {
  $totalRows_RsNoticias = $_GET['totalRows_RsNoticias'];
} else {
  $all_RsNoticias = mysql_query($query_RsNoticias);
  $totalRows_RsNoticias = mysql_num_rows($all_RsNoticias);
}
$totalPages_RsNoticias = ceil($totalRows_RsNoticias/$maxRows_RsNoticias)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/modelo.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>|| Saquabb.com.br - 2010 - 8 anos ||</title>
<!-- InstanceEndEditable -->
<link type="text/css" href="jquery/js/themes/ui-lightness/ui.all.css" rel="stylesheet" />
   	<script type="text/javascript" src="jquery/js/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="jquery/js/ui/ui.core.js"></script>
	<script type="text/javascript" src="jquery/js/ui/ui.accordion.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
    $('#switcher').themeswitcher();
  });
	</script>

	<!-- InstanceBeginEditable name="head" -->
	<!-- InstanceEndEditable -->
</head>
<body>
<script type="text/javascript" src="http://jqueryui.com/themeroller/themeswitchertool/"></script>
<table width="800" border="0" align="center" cellpadding="4" cellspacing="8">
    <tr>
     <td colspan="3" align="right" valign="middle">
         <table width="45%" border="0" cellspacing="2" cellpadding="0">
           <tr>
             <td align="right" valign="middle">Utilize o menu para mudar o estilo do site:</td>
             <td align="right" valign="middle"><div id="switcher"></div></td>
           </tr>
         </table>
     </td>
  </tr>
   <tr>
    <td height="72" colspan="3" class="ui-state-hover"><h1><img src="imagens/logo.png" width="368" height="77" alt="Saquabb.com.br" /></h1></td>
  </tr>
    <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="ui-widget-header ui-corner-bl ui-corner-tr">
      <tr>
      	<td align="left" valign="middle"><span class="ui-icon ui-icon-home"></span></td>
      	<td align="left" valign="middle"><a href="index.php">IN�CIO</a></td>
        <td align="left" valign="middle"><span class="ui-icon ui-icon-signal-diag"></span></td>
        <td align="left" valign="middle" ><a href="noticias.php">NOT&Iacute;CIAS</a></td>
        <td align="left" valign="middle"><span class="ui-icon ui-icon-image"></span></td>
        <td align="left" valign="middle"><a href="#">FOTOS</a></td>
        <td align="left" valign="middle"><span class="ui-icon ui-icon-contact"></span></td>
        <td align="left" valign="middle"><a href="#">CONTATO</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="500" align="left" valign="top"><!-- InstanceBeginEditable name="conteudo" -->
      <script>    
    $(function() {
		$("#accordion").accordion({
			collapsible: true,
			autoHeight: false
		});
	});
    </script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td align="left" valign="top">
    <div id="accordion">
       <?php do { ?>
        <h3><a href="#"><?php echo $row_RsNoticias['titulo']; ?></a></h3>
        <div>
          <?php if ($row_RsNoticias['imagem'] != '') { // Show if recordset not empty ?>
          <table width="400" border="0" cellpadding="8" cellspacing="0" class="ui-state-hover">
            <tr>
              <td><img src="<?php echo $objDynamicThumb2->Execute(); ?>" border="0" /></td>
            </tr>
          </table>
          <?php } // Show if recordset not empty ?>
          <br>
          <strong>Data:</strong> <?php echo $row_RsNoticias['data']; ?> <strong>Fonte:</strong> <?php echo $row_RsNoticias['fonte']; ?><br>
          <br>
          <?php echo $row_RsNoticias['materia']; ?>
		  </div>
        <?php } while ($row_RsNoticias = mysql_fetch_assoc($RsNoticias)); ?>       
    </div>
    </td>
  </tr>
</table>
    <!-- InstanceEndEditable --></td>
<td align="center" valign="top">
      <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ui-widget-header ui-corner-bl ui-corner-tr">
        <tr>
          <td align="left" valign="middle" class="ui-icon ui-icon-person"><!----></td>
      	  <td align="left" valign="middle">GALERIAS DE FOTOS</td>
        </tr>
    </table>
      <?php 
	  //$i = 0;
	  //$cor;
	  do { 	  
	 // if($i % 2 == 0){ $cor = 'ui-state-hover semBorda';}
	 // else{$cor = '';}
	 // $i++;
	  
	  ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="3" class="borda_linha">
          <tr>
            <td width="17%" align="left" valign="middle"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" width="40" height="40" border="0" class="ui-state-highlight" /></td>
            <td width="83%" align="left" valign="middle"><?php echo $row_RsGalerias['nome']; ?></td>
          </tr>
        </table>
        <?php    } while ($row_RsGalerias = mysql_fetch_assoc($RsGalerias)); ?><br/>Ver todas as galerias
<br/><br />



<table width="100%" border="0" cellspacing="2" cellpadding="0" class="ui-widget-header ui-corner-bl ui-corner-tr">
  <tr>
    <td align="left" valign="middle" class="ui-icon ui-icon-star"><!----></td>
    <td align="left" valign="middle">PARCEIROS</td>
    </tr>
</table>
    <table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><ul>
            <li><a href="#"></a></li>
          </ul></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" class="ui-state-hover">&nbsp;</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RsNoticias);
mysql_free_result($RsGalerias);
?>
