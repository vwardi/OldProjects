<?php require_once('../Connections/fotos.php'); ?>
<?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

$colname_fotos = "-1";
if (isset($_GET['id_foto'])) {
  $colname_fotos = (get_magic_quotes_gpc()) ? $_GET['id_foto'] : addslashes($_GET['id_foto']);
}
mysql_select_db($database_fotos, $fotos);
$query_fotos = sprintf("SELECT * FROM fotos_digitais WHERE id_foto = %s ORDER BY id_foto DESC", $colname_fotos);
$fotos = mysql_query($query_fotos, $fotos) or die(mysql_error());
$row_fotos = mysql_fetch_assoc($fotos);
$totalRows_fotos = mysql_num_rows($fotos);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Saquabb.com.br __________ Fotos Digitais [Bodyboard] [Surf] [Visual] [Gatas] ______________________________</title>
<SCRIPT language=JavaScript>
	<!--
	curPage=1;
	document.oncontextmenu = function(){return false}
	if(document.layers) {
		window.captureEvents(Event.MOUSEDOWN);
		window.onmousedown = function(e){
			if(e.target==document)return false;
		}
	}
	else {
		document.onmousedown = function(){return false}
	}
	//-->
	</SCRIPT>

<link href="stilo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: none;
	color: #FFFFFF;
}
a:active {
	text-decoration: none;
	color: #FFFFFF;
}
-->
</style></head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="Untitled" fwbase="foto.hmt.jpg" fwstyle="Dreamweaver" fwdocid = "1276698900" fwnested="0" -->
  <tr>
    <td><img src="imagens/verfoto/spacer.gif" width="52" height="1" border="0" alt="" /></td>
    <td><img src="imagens/verfoto/spacer.gif" width="500" height="1" border="0" alt="" /></td>
    <td><img src="imagens/verfoto/spacer.gif" width="48" height="1" border="0" alt="" /></td>
    <td><img src="imagens/verfoto/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="3"><img name="fotohmt_r1_c1" src="imagens/verfoto/foto.hmt_r1_c1.jpg" width="600" height="40" border="0" id="fotohmt_r1_c1" alt="" /></td>
    <td><img src="imagens/verfoto/spacer.gif" width="1" height="40" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="fotohmt_r2_c1" src="imagens/verfoto/foto.hmt_r2_c1.jpg" width="52" height="375" border="0" id="fotohmt_r2_c1" alt="" /></td>
    <td align="center" valign="middle" background="imagens/carregando.jpg" bgcolor="#FFFFFF"><img src="<?php echo tNG_showDynamicImage("../", "../fotos/fotos_digitais/", "{fotos.arquivo}");?>" /></td>
    <td><img name="fotohmt_r2_c3" src="imagens/verfoto/foto.hmt_r2_c3.jpg" width="48" height="375" border="0" id="fotohmt_r2_c3" alt="" /></td>
    <td><img src="imagens/verfoto/spacer.gif" width="1" height="375" border="0" alt="" /></td>
  </tr>
  <tr>
    <td height="48" colspan="3" align="right" valign="bottom" background="imagens/verfoto/foto.hmt_r3_c1.jpg"><table border="0" width="47%" align="right">
      <tr>
        <td height="44" align="right" valign="middle" class="nagegation">&nbsp;</td>
        </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="119" colspan="3" align="right" valign="top"><table width="90%" border="0" cellspacing="4" cellpadding="0">
      <tr>
        <th width="52%" align="left" class="nome" scope="col"><?php echo $row_fotos['descricao']; ?></th>
        <th rowspan="4" align="center" valign="middle" class="negrito" scope="col"><img src="imagens/comprar.jpg" alt="Comprar!" width="150" height="70" /></th>
      </tr>
      <tr>
        <th height="21" align="left" class="fonte" scope="row"><span class="negrito">Local :</span> <?php echo $row_fotos['local']; ?></th>
        </tr>
      <tr>
        <th height="19" align="left" class="fonte" scope="col"><span class="negrito">Fot&oacute;grafo :</span><span class="fonte"> <?php echo $row_fotos['fotografo']; ?></span></th>
        </tr>
      <tr>
        <td height="19" align="left"><span class="negrito">C&oacute;digo : <span class="fonte"><?php echo $row_fotos['id_foto']; ?></span></span></td>
        </tr>
      <tr>
        <th height="20" colspan="2" align="left" class="nome" scope="col">&nbsp;</th>
        </tr>
      
    </table></td>
    <td><img src="imagens/verfoto/spacer.gif" width="1" height="57" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="3" align="right" valign="top"><img src="imagens/rodape.jpg" width="600" height="28" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($fotos);
?>
