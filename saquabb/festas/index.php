<?php require_once('../Connections/saquabb.php'); ?>
<?php
// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

$maxRows_festas = 6;
$pageNum_festas = 0;
if (isset($_GET['pageNum_festas'])) {
  $pageNum_festas = $_GET['pageNum_festas'];
}
$startRow_festas = $pageNum_festas * $maxRows_festas;

mysql_select_db($database_saquabb, $saquabb);
$query_festas = "SELECT * FROM festas ORDER BY id DESC";
$query_limit_festas = sprintf("%s LIMIT %d, %d", $query_festas, $startRow_festas, $maxRows_festas);
$festas = mysql_query($query_limit_festas, $saquabb) or die(mysql_error());
$row_festas = mysql_fetch_assoc($festas);

if (isset($_GET['totalRows_festas'])) {
  $totalRows_festas = $_GET['totalRows_festas'];
} else {
  $all_festas = mysql_query($query_festas);
  $totalRows_festas = mysql_num_rows($all_festas);
}
$totalPages_festas = ceil($totalRows_festas/$maxRows_festas)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template_site.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<SCRIPT language=JavaScript type=text/javascript>
<!--
function AbrirGaleria(id)
{
 window.open("galerias/popup.php?id="+id,"","resizable=no,toolbar=no,status=0,menubar=no,scrollbars=no,width=450,height=420");
}
// -->
</SCRIPT>
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="../css.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:260px;
	height:70px;
	z-index:1;
	left: 17px;
	top: 21px;
	background-color: #FFFF33;
	overflow: hidden;
}
-->
</style>
</head>
<script language="JavaScript" src="../java.js"></script>
<body>
<table width="739" height="720" border="0" align="center" cellpadding="0" cellspacing="0" class="borda_tabela">
  <tr>
    <td height="53" colspan="2" align="center" valign="top"><a href="../carnaporto/index.php"></a><img src="../imagens/banner.jpg" width="775" height="120" /></td>
  </tr>
      <tr>
        <td width="198" align="center" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td align="center" valign="top"><table width="190" height="389" border="0" cellpadding="0" cellspacing="1">
              <tr>
                <td height="336" align="center" valign="top"><table  width="190" height="336" cellpadding="0" cellspacing="2" class="borda_fundo_noticas">
                    <tr>
                      <td height="330" align="center" valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr>
                            <td colspan="2" align="left" class="tiutlo_not"><table class="borda_titulo_menu" width="100%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td align="left" valign="middle">Principal</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../index.php">Home</a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"> <a href="../arquivo.php">Arquivo de Not&iacute;cias </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../galerias.php">Galerias de Fotos</a> </td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="javascript:abrir_janela('../gatinhas/index.php?galeria=gatas','Saquabb','','700','500','true')">Gatinhas</a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../perfil.php">Perfil dos Atletas </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="javascript:abrir_janela('../perfil/cadastrar.php','Cadastre','scrollbars=1','570','562','true')">Cadastrar Perfil </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../contato.php">Fale Conosco </a></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table class="borda_titulo_variedades" width="100%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td align="left" valign="middle" class="tiutlo_not">BBLagos</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"> <a href="../bblagos/index.php">Not&iacute;cias</a> </td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../bblagos/circuito.php">O Circuito </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="javascript:abrir_janela('../album/index.php?galeria=bblagos','Saquabb','','700','500','true')">Galeria de Fotos </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../bblagos/etapas.php">Etapas 2006 </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../bblagos/ranking.php">Ranking</a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../bblagos/info.php">Informa&ccedil;&otilde;es</a></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table class="borda_titulo_girls" width="100%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td align="left" valign="middle" class="tiutlo_not">Saquabb Girls </td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../girls/index.php">Not&iacute;cias </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="javascript:abrir_janela('../album/index.php?galeria=girls','Saquabb','','700','500','true')">Galeria de Fotos </a></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table class="borda_titulo_bblagos" width="100%" border="0" cellspacing="0" cellpadding="2">
                              <tr>
                                <td align="left" valign="middle" class="tiutlo_not">Variedades</td>
                              </tr>
                            </table></td>
                          </tr>
                          
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="index.php">Fotos das Festas </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../vemai.php">Vem a&iacute;... </a></td>
                          </tr>
                          <tr>
                            <td><img src="../imagens/titulos/marcador.jpg" width="8" height="10" /></td>
                            <td align="left" valign="middle"><a href="../festa_anuncio.php">Anuncie sua Festa </a></td>
                          </tr>
                          
                      </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center" valign="top"><table width="190" border="0" cellpadding="0" cellspacing="0" class="borda_tabela">
                    <tr>
                      <td align="left" valign="middle" bgcolor="#333333"><img src="../imagens/titulos/publicidade.jpg" width="118" height="20" /></td>
                    </tr>
                    <tr>
                      <td height="13" align="center" valign="middle"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                          <tr>
                            <td align="center" valign="middle"><a href="http://ww.rbprovider.com"><img src="../imagens/publicidade/logorb.jpg" alt="RB Provider" width="170" height="54" border="0" /></a></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="13" align="center" valign="middle"><a href="http://ww.saquab.com.br"><img src="../imagens/publicidade/saqua.jpg" alt="Saqua.com.br" width="170" height="64" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td height="58" align="center" valign="middle"><a href="http://www.redsdesign.com.br"><img src="../imagens/publicidade/banner_reds.gif" alt="Reds Design!" width="170" height="50" border="0" longdesc="http://www.redsdesign.com.br" /></a></td>
                    </tr>
                    <tr>
                      <td height="13" align="center" valign="middle"><br />
                        <a href="http://www.gnunes.net"><img src="../imagens/publicidade/gnunes.jpg" alt="Gnunes!" width="170" height="50" border="0" class="borda_tabela" /></a><br />
                      <br /></td>
                    </tr>
                </table></td>
              </tr>
              
            </table></td>
          </tr>
        </table></td>
        <td width="539" height="193" align="center" valign="top"><!-- InstanceBeginEditable name="conteudo" -->
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td><table width="570" border="0" cellpadding="0" cellspacing="4" class="borda_fundo_destaque">
                <tr>
                  <td><table width="100%" border="0" cellpadding="0" cellspacing="2" class="borda_topo">
                    <tr>
                      <td align="left" valign="top"><img src="../imagens/titulos/festas.jpg" alt="fotos festas" width="128" height="20" /></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <?php
  do { // horizontal looper version 3
?>
                          <td width="100"><table width="120" border="0" cellspacing="2" cellpadding="0">
                            
                            <tr>
                              <td align="center" valign="middle"><table width="44" border="1" cellpadding="0" cellspacing="2" bordercolor="#666666" bgcolor="#FFFFFF">
                                  <tr>
                                    <td width="36"><a href="javascript:AbrirGaleria('<?php echo $row_festas['pasta']; ?>');"><img src="<?php echo tNG_showDynamicThumbnail("../", "../uploads/fotos/", "{festas.imagem}", 180, 0, true); ?>" border="0" /></a></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td height="26" align="center" valign="middle"><?php echo $row_festas['nome']; ?><br />
                              <?php echo $row_festas['data']; ?> </td>
                            </tr>
                          </table></td>
                          <?php
    $row_festas = mysql_fetch_assoc($festas);
    if (!isset($nested_festas)) {
      $nested_festas= 1;
    }
    if (isset($row_festas) && is_array($row_festas) && $nested_festas++ % 3==0) {
      echo "</tr><tr>";
    }
  } while ($row_festas); //end horizontal looper version 3
?>
                      </tr>
                  </table></td></tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table>
        <!-- InstanceEndEditable --></td>
      </tr>
      <tr>
        <td height="40" colspan="2" align="center" valign="top"><img src="../imagens/rodape.jpg" alt="rodape" width="775" height="40" /></td>
      </tr>
</table>    
</td>
  </tr>
  <tr>
</tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($festas);
?>