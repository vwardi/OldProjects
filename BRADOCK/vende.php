<?php require_once('Connections/ConBD.php'); ?>
<?php
// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

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

mysql_select_db($database_ConBD, $ConBD);
$query_RsImovel = "SELECT * FROM imovel WHERE tipo = 'venda' ORDER BY id DESC";
$RsImovel = mysql_query($query_RsImovel, $ConBD) or die(mysql_error());
$row_RsImovel = mysql_fetch_assoc($RsImovel);
$totalRows_RsImovel = mysql_num_rows($RsImovel);

// Show Dynamic Thumbnail
$objDynamicThumb1 = new tNG_DynamicThumbnail("", "KT_thumbnail1");
$objDynamicThumb1->setFolder("uploads/fotos/");
$objDynamicThumb1->setRenameRule("{RsImovel.imagem}");
$objDynamicThumb1->setResize(100, 80, false);
$objDynamicThumb1->setWatermark(false);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/TEMPLATE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>|| Bradock ||</title>
<!-- InstanceEndEditable -->
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<table width="766" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','766','height','374','src','flash/header_V8','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','flash/header_V8' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="766" height="374">
      <param name="movie" value="Templates/flash/header_V8.swf" />
      <param name="quality" value="high" />
      <embed src="Templates/flash/header_V8.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="766" height="374"></embed>
    </object></noscript></td>
  </tr>
  <tr>
    <td height="19" background="imagens/recotes_02.jpg"><!-- InstanceBeginEditable name="conteudo" -->
      <table width="766" height="98" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="539">
          <h2 class="titulo_pg">Galeria de Casas</h2>
        <div id="texto">       
      <p class="novidade_texto">Confira as melhores Casas da regiao</p>
        <?php do { ?>
        <div class="novidades_titulo">
          <table width="95%" border="0" cellpadding="0" cellspacing="6" class="linha_trecajada">
            <tr>
              <td width="15%" align="left" valign="middle"><table width="121" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3"><img src="img/recortes/moldura/foto_r1_c1.jpg" width="120" height="10" /></td>
                    </tr>
                  <tr>
                    <td width="10"><img src="img/recortes/moldura/foto_r2_c1.jpg" width="10" height="75" /></td>
                    <td width="100"><a href="casa.php?id=<?php echo $row_RsImovel['id'];?>"><img src="<?php echo $objDynamicThumb1->Execute(); ?>" width="100" height="75" border="0" class="borda_foto" /></a></td>
                    <td width="11"><img src="img/recortes/moldura/foto_r2_c3.jpg" width="10" height="75" /></td>
                  </tr>
                  <tr>
                    <td colspan="3"><img src="img/recortes/moldura/foto_r3_c1.jpg" width="120" height="10" /></td>
                    </tr>
                </table></td>
              <td width="85%" align="left" valign="middle" class="novidades_titulo"><a href="casa.php?id=<?php echo $row_RsImovel['id'];?>" class="titulo"><?php echo $row_RsImovel['titulo']; ?></a></td>
            </tr>
          </table>
          </div>
        <?php } while ($row_RsImovel = mysql_fetch_assoc($RsImovel)); ?>
      </div>
      <br />
        </td>
          <td width="227"><p>...........</p>
          </td>
        </tr>
      </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td height="45"><img src="imagens/recotes_03.jpg" width="766" height="179" /></td>
  </tr>
  <tr>
    <td height="9"><img src="imagens/recotes_04.jpg" width="766" height="55" border="0" usemap="#Map" /></td>
  </tr>
</table>

<map name="Map" id="Map">
  <area shape="rect" coords="61,5,103,32" href="index.php" /><area shape="rect" coords="120,7,196,34" href="quem.php" />
<area shape="rect" coords="206,9,251,35" href="html antigas/vende.html" />
<area shape="rect" coords="263,8,309,37" href="html antigas/aluga.html" />
<area shape="rect" coords="318,5,412,38" href="pousada.php" />
<area shape="rect" coords="427,8,507,33" href="#" /><area shape="rect" coords="524,8,578,33" href="contato.html" />
</map></body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RsImovel);
?>

