<%@LANGUAGE="VBSCRIPT"%>
<!--#include file="Connections/conexao.asp" -->
<%
Dim RsNot
Dim RsNot_numRows

Set RsNot = Server.CreateObject("ADODB.Recordset")
RsNot.ActiveConnection = MM_conexao_STRING
RsNot.Source = "SELECT * FROM noticias ORDER BY CodNoticia DESC"
RsNot.CursorType = 0
RsNot.CursorLocation = 2
RsNot.LockType = 1
RsNot.Open()

RsNot_numRows = 0
%>
<%
Dim bblagos_fotos
Dim bblagos_fotos_numRows

Set bblagos_fotos = Server.CreateObject("ADODB.Recordset")
bblagos_fotos.ActiveConnection = MM_conexao_STRING
bblagos_fotos.Source = "SELECT * FROM high_quality_photos ORDER BY cod DESC"
bblagos_fotos.CursorType = 0
bblagos_fotos.CursorLocation = 2
bblagos_fotos.LockType = 1
bblagos_fotos.Open()

bblagos_fotos_numRows = 0
%>
<%
Dim Rs_Ramk_A
Dim Rs_Ramk_A_numRows

Set Rs_Ramk_A = Server.CreateObject("ADODB.Recordset")
Rs_Ramk_A.ActiveConnection = MM_conexao_STRING
Rs_Ramk_A.Source = "SELECT * FROM ranking_a ORDER BY colocacao ASC"
Rs_Ramk_A.CursorType = 0
Rs_Ramk_A.CursorLocation = 2
Rs_Ramk_A.LockType = 1
Rs_Ramk_A.Open()

Rs_Ramk_A_numRows = 0
%>
<%
Dim Rs_rank_m
Dim Rs_rank_m_numRows

Set Rs_rank_m = Server.CreateObject("ADODB.Recordset")
Rs_rank_m.ActiveConnection = MM_conexao_STRING
Rs_rank_m.Source = "SELECT * FROM ranking_m ORDER BY colocacao ASC"
Rs_rank_m.CursorType = 0
Rs_rank_m.CursorLocation = 2
Rs_rank_m.LockType = 1
Rs_rank_m.Open()

Rs_rank_m_numRows = 0
%>
<%
Dim Repeat1__numRows
Dim Repeat1__index

Repeat1__numRows = 5
Repeat1__index = 0
RsNot_numRows = RsNot_numRows + Repeat1__numRows
%>
<%
Dim Repeat2__numRows
Dim Repeat2__index

Repeat2__numRows = 2
Repeat2__index = 0
bblagos_fotos_numRows = bblagos_fotos_numRows + Repeat2__numRows
%>
<%
Dim Repeat3__numRows
Dim Repeat3__index

Repeat3__numRows = 4
Repeat3__index = 0
Rs_Ramk_A_numRows = Rs_Ramk_A_numRows + Repeat3__numRows
%>
<%
Dim Repeat4__numRows
Dim Repeat4__index

Repeat4__numRows = 4
Repeat4__index = 0
Rs_rank_m_numRows = Rs_rank_m_numRows + Repeat4__numRows
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/modelo.dwt.asp" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>SAQUABB.com.br _________ By Wardesign.com.br _____________________________________________________________________________</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	background-image:  url(../imagens/fundo.gif);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.brd {border: 1px solid #000000;
}
.style23 {
	font-size: 10px;
	color: #FF6600;
	font-weight: bold;
}
body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 10px;
	font-weight: bold;
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: none;
	color: #FF9900;
}
a:active {
	text-decoration: none;
	color: #000000;
}
.style59 {
	font-size: 10px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000000;
}
.style60 {font-weight: bolder; font-family: Geneva, Arial, Helvetica, sans-serif;}
a {
	font-weight: bold;
}
.linha {
	border-bottom-style: solid;
	border-bottom-color: #000000;
	border-bottom-width: 1px;	
	
}
.mao {
	cursor: hand;
}
-->
</style>
<script language="JavaScript" src="banco_de_dados/java.js"></script>
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style64 {font-size: 11px}
.style14 {font-size: 9px}
.style66 {color: #FF0000}
-->
</style>
<!-- InstanceEndEditable -->

</head>

<body>
<table width="779" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="brd">
  <tr>
    <th align="center" valign="top" scope="col"><table width="779" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666" bgcolor="#FFFFFF">
      <tr>
        <th align="center" valign="top" scope="col"><table  border="0" cellpadding="0" cellspacing="0">
            <tr align="left" valign="top">
              <th colspan="3" scope="col"><img src="../imagens/topo/modelos/topo_r1_c1.jpg" width="779" height="17"></th>
            </tr>
            <tr>
              <th rowspan="2" scope="col"><img src="../imagens/topo/modelos/topo_r2_c1.jpg" width="10" height="139"></th>
              <td height="43"><img src="../publicidade/saquabb_publicidade.gif" width="468" height="60"></td>
              <td rowspan="2" align="left" valign="top"><img src="../imagens/topo/modelos/topo_r2_c5.jpg" width="301" height="139" border="0" usemap="#Map2"></td>
            </tr>
            <tr>
              <td align="left" valign="top"><img src="../imagens/topo/modelos/topo_r3_c2.jpg" width="468" height="79" border="0" usemap="#Map"></td>
            </tr>
            <tr>
              <td colspan="3"><!-- InstanceBeginEditable name="titulo" -->
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <th width="21%" align="left" scope="col"><img src="../imagens/topo/modelos/topo_r4_c1.jpg" width="170" height="64"></th>
                    <th width="48%" align="center" valign="top" scope="col">&nbsp;</th>
                    <th width="31%" align="right" valign="top" scope="col"><img src="../imagens/topo/modelos/topo_r4_c4.jpg" width="319" height="64"></th>
                  </tr>
                </table>
              <!-- InstanceEndEditable --></td>
            </tr>
        </table></th>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="80%" align="center" valign="top" scope="col"><!-- InstanceBeginEditable name="tabela_principal" -->
          <table width="610" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th align="center" valign="bottom" scope="col"><img src="topo.jpg" width="610" height="120"></th>
            </tr>
            <tr>
              <td align="center" valign="top" background="../imagens/fundo_tabela.jpg"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="60%" scope="col">&nbsp;</th>
                      <th width="40%" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                      <td rowspan="4" align="center" valign="top"><table width="350" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <th scope="col"><img src="imagens/topo_not.jpg" width="350" height="22"></th>
                          </tr>
                          <tr>
                            <td background="imagens/meio_not.jpg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <th scope="col">
                                    <% 
While ((Repeat1__numRows <> 0) AND (NOT RsNot.EOF)) 
%>
                                    <table width="96%" border="0" cellpadding="0" cellspacing="0" class="linha">
                                      <tr align="center" valign="middle" >
                                        <th width="116" height="80"  scope="col"><table width="100%" height="80"  border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <th scope="col"><span class="data"><a href="ver.asp?CodNot=<%=(RsNot.Fields.Item("CodNoticia").Value)%>"><img src="fotos/peq/<%=(RsNot.Fields.Item("foto").Value)%>" alt="<%=(RsNot.Fields.Item("titulo").Value)%>" hspace="5" border="0" align="center" class="brd"></a></span></th>
                                            </tr>
                                        </table>                                    </th>
                                        <th width="243" align="left" class="style3" scope="col">
                                          <table width="90%"  border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <th align="left" class="style4" scope="col">&nbsp;<span class="style14"><a href="ver.asp?CodNot=<%=(RsNot.Fields.Item("CodNoticia").Value)%>"><%=(RsNot.Fields.Item("data").Value)%> - <%=(RsNot.Fields.Item("titulo").Value)%></a></span></th>
                                            </tr>
                                        </table></th>
                                      </tr>
                                    </table>
                                  <% 
  Repeat1__index=Repeat1__index+1
  Repeat1__numRows=Repeat1__numRows-1
  RsNot.MoveNext()
Wend
%></th>
                                </tr>
                            </table>                            </td>
                          </tr>
                          <tr>
                            <td align="center" valign="top" background="imagens/meio_not.jpg"><span class="style64"><a href="arquivo.asp">+ Todas as Not&iacute;cias</a></span></td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><img src="imagens/base_not.jpg" width="350" height="7"></td>
                          </tr>
                      </table></td>
                      <td align="center" valign="top"><table width="230" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <th scope="col"><img src="imagens/topo_fotos.jpg" width="230" height="24"></th>
                        </tr>
                        <tr>
                          <td align="center" valign="middle" background="imagens/meio_rk.jpg">
                            <% 
While ((Repeat2__numRows <> 0) AND (NOT bblagos_fotos.EOF)) 
%>
                            <table width="96%"  border="0" align="center" cellpadding="0" cellspacing="0" class="linha">
                              <tr>
                                <th scope="col"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <th width="25%" height="80" scope="col"><span class="data"><a href="javascript:MM_openBrWindow('high_quality_photos/galerias_de_fotos/?Cod=<%=(bblagos_fotos.Fields.Item("cod").Value)%>','Saquabb','','770','600','true')"><img src="fotos/<%=(bblagos_fotos.Fields.Item("thumb").Value)%>" width="80" height="60" hspace="5" border="0" align="center" class="brd"></a></span></th>
                                      <th width="75%" scope="col"><span class="style64"><a href="javascript:MM_openBrWindow('high_quality_photos/galerias_de_fotos/?Cod=<%=(bblagos_fotos.Fields.Item("cod").Value)%>','Saquabb','','770','600','true')" class="style59"><%=(bblagos_fotos.Fields.Item("nome").Value)%></a></span></th>
                                    </tr>
                                </table></th>
                              </tr>
                            </table>
                            <% 
  Repeat2__index=Repeat2__index+1
  Repeat2__numRows=Repeat2__numRows-1
  bblagos_fotos.MoveNext()
Wend
%></td>
                        </tr>
                        <tr>
                          <td valign="top"><img src="imagens/base_rk.jpg" width="230" height="6"></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" valign="top"><table width="230" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <th scope="col"><img src="imagens/topo_rk.jpg" width="230" height="24"></th>
                        </tr>
                        <tr>
                          <td align="center" valign="top" background="imagens/meio_rk.jpg"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <th align="left" scope="col">&nbsp;</th>
                              </tr>
                              <tr>
                                <th height="25" align="left" scope="col"><img src="imagens/amador.jpg" width="50" height="20"></th>
                              </tr>
                              <tr>
                                <td>
                                  <% 
While ((Repeat3__numRows <> 0) AND (NOT Rs_Ramk_A.EOF)) 
%>
                                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <th align="left" scope="col"><span class="style64"><span class="style66"><%=(Rs_Ramk_A.Fields.Item("colocacao").Value)%></span> - <%=(Rs_Ramk_A.Fields.Item("nome").Value)%> - <%=(Rs_Ramk_A.Fields.Item("pontos").Value)%> pontos </span></th>
                                    </tr>
                                  </table>
                                  <% 
  Repeat3__index=Repeat3__index+1
  Repeat3__numRows=Repeat3__numRows-1
  Rs_Ramk_A.MoveNext()
Wend
%>
                                  <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="linha">
                                    <tr>
                                      <th align="left" scope="col">&nbsp;</th>
                                    </tr>
                                  </table></td>
                              </tr>
                              <tr>
                                <td height="25" align="left"><img src="imagens/mirim.jpg" width="50" height="20"></td>
                              </tr>
                              <tr>
                                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="5" align="left">
                                      <% 
While ((Repeat4__numRows <> 0) AND (NOT Rs_rank_m.EOF)) 
%>
                                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th align="left" scope="col"><span class="style64"><span class="style66"><%=(Rs_rank_m.Fields.Item("colocacao").Value)%></span> - <%=(Rs_rank_m.Fields.Item("nome").Value)%> - <%=(Rs_rank_m.Fields.Item("pontos").Value)%> pontos</span></th>
                                        </tr>
                                                                          </table>
                                      <% 
  Repeat4__index=Repeat4__index+1
  Repeat4__numRows=Repeat4__numRows-1
  Rs_rank_m.MoveNext()
Wend
%></td>
                                  </tr>
                                  <tr>
                                    <td height="5" align="left"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="linha">
                                      <tr>
                                        <th scope="col">&nbsp;</th>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td height="15" align="center" valign="middle">                                      <div align="center" class="style64"><a href="ranking.asp">Ver Ranking Completo </a></div></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>                            </td>
                        </tr>
                        <tr>
                          <td valign="top"><img src="imagens/base_rk.jpg" width="230" height="6"></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="center" valign="top">&nbsp;</td>
                    </tr>
                  </table>                  
              <p>&nbsp;</p>                </td>
            </tr>
            <tr>
              <td align="center" valign="top"><img src="../imagens/base_tabela.jpg" width="610" height="7"></td>
            </tr>
          </table>
          <br>
        <!-- InstanceEndEditable --></th>
        <th width="20%" align="center" valign="top" scope="col"><!-- InstanceBeginEditable name="publicidade" -->
          <table width="150"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th scope="col"><img src="imagens/topo_apoio.jpg" width="150" height="31"></th>
            </tr>
            <tr>
              <td align="center" valign="top" background="../retalhos/meio_publi.jpg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="33" align="center" valign="middle"><br>                      <img src="imagens/apoiadores/saquabb.jpg" width="140" height="80"></td>
                  </tr>
                  <tr>
                    <th height="33" align="center" valign="middle" scope="col"><img src="imagens/apoiadores/abc.jpg" width="108" height="65"></th>
                  </tr>
                  <tr>
                    <td height="33" align="center" valign="middle"><img src="imagens/apoiadores/ok.jpg" width="110" height="81"></td>
                  </tr>
                  <tr>
                    <td height="33" align="center" valign="middle"><img src="imagens/apoiadores/dl.jpg" width="140" height="46"></td>
                  </tr>
                  <tr>
                    <td height="72" align="center" valign="middle"><img src="imagens/apoiadores/bac.jpg" width="140" height="59"></td>
                  </tr>
                  <tr>
                    <td height="156" align="center" valign="top">&nbsp;</td>
                  </tr>
                </table>
                  <p>&nbsp;</p></td>
            </tr>
            <tr>
              <td align="center" valign="top"><img src="../retalhos/base_publi.jpg" width="150" height="12"></td>
            </tr>
          </table>
        <!-- InstanceEndEditable --></th>
      </tr>
      <tr>
        <th colspan="2" align="center" valign="top" scope="col"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th height="10" align="center" valign="top" background="../retalhos/fundo_base.jpg" scope="col"><img src="../retalhos/fundo_base.jpg" width="1" height="10"></th>
          </tr>
          <tr>
            <td height="25" align="center" valign="middle" background="../retalhos/meio_fundo.jpg" bgcolor="#D65501"><span class="style59"><a href="../home.asp">Home</a> -<a href="../arquivo.asp"> Not&iacute;cias</a> - <a href="../galerias.asp">Galerias</a> -<a href="../atletas.asp"> Atletas</a> - <a href="../festa.asp">Festas</a> - <a href="../contato.asp" class="style60">Contato</a></span> </td>
          </tr>
          <tr>
            <td background="../retalhos/fundo_base_invert.jpg"><img src="../retalhos/fundo_base_invert.jpg" width="1" height="10"></td>
          </tr>
        </table></th>
      </tr>
      <tr valign="middle" bgcolor="#FFE6CC">
        <th height="25" colspan="2" align="center" scope="col"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th class="style23" scope="col"> Saquabb.com.br &copy; 2005 . Todos os Direitos Reservados . Desenvolvido Por <a href="http://www.wardesign.com.br">Wardesign.com.br </a> </th>
          </tr>
        </table></th>
        </tr>
    </table></td>
  </tr>
</table>
<map name="Map">
  <area shape="rect" coords="62,60,105,79" href="../home.asp">
  <area shape="rect" coords="120,42,186,61" href="../arquivo.asp">
  <area shape="rect" coords="201,31,268,46" href="../galerias.asp">
  <area shape="rect" coords="283,26,341,47" href="../atletas.asp">
  <area shape="rect" coords="357,28,412,58" href="../festa.asp">
  <area shape="rect" coords="424,46,482,76" href="../contato.asp">
  <area shape="rect" coords="466,59,479,75" href="#">
  <area shape="rect" coords="25,67,44,86" href="../contato.asp">
  <area shape="rect" coords="2,69,15,83" href="../home.asp">
</map>
<map name="Map2">
  <area shape="rect" coords="-3,120,15,135" href="../contato.asp">
</map>
</body>
<!-- InstanceEnd --></html>
<%
RsNot.Close()
Set RsNot = Nothing
%>
<%
bblagos_fotos.Close()
Set bblagos_fotos = Nothing
%>
<%
Rs_Ramk_A.Close()
Set Rs_Ramk_A = Nothing
%>
<%
Rs_rank_m.Close()
Set Rs_rank_m = Nothing
%>
