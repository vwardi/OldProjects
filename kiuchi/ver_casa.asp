<%@LANGUAGE="VBSCRIPT"%>
<!--#include file="Connections/conex2.asp" -->
<%
Dim Rs_imovel__MMColParam
Rs_imovel__MMColParam = "1"
If (Request.QueryString("codnot") <> "") Then 
  Rs_imovel__MMColParam = Request.QueryString("codnot")
End If
%>
<%
Dim Rs_imovel
Dim Rs_imovel_numRows

Set Rs_imovel = Server.CreateObject("ADODB.Recordset")
Rs_imovel.ActiveConnection = MM_conex2_STRING
Rs_imovel.Source = "SELECT * FROM casa WHERE codnoticia = " + Replace(Rs_imovel__MMColParam, "'", "''") + " ORDER BY codnoticia DESC"
Rs_imovel.CursorType = 0
Rs_imovel.CursorLocation = 2
Rs_imovel.LockType = 1
Rs_imovel.Open()

Rs_imovel_numRows = 0
%>
<%
Dim Fotos__MMColParam
Fotos__MMColParam = "1"
If (Request.QueryString("CodNot") <> "") Then 
  Fotos__MMColParam = Request.QueryString("CodNot")
End If
%>
<%
Dim Fotos
Dim Fotos_numRows

Set Fotos = Server.CreateObject("ADODB.Recordset")
Fotos.ActiveConnection = MM_conex2_STRING
Fotos.Source = "SELECT * FROM casa_foto WHERE CodNoticia = " + Replace(Fotos__MMColParam, "'", "''") + " ORDER BY CodNoticia DESC"
Fotos.CursorType = 0
Fotos.CursorLocation = 2
Fotos.LockType = 1
Fotos.Open()

Fotos_numRows = 0
%>
<%
Dim Repeat1__numRows
Dim Repeat1__index

Repeat1__numRows = -1
Repeat1__index = 0
Fotos_numRows = Fotos_numRows + Repeat1__numRows
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>kiuchiimobiliaria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript"> <br>

<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<style type="text/css">
<!--
a:link {
	color: #FF3300;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #000000;
}
a:active {
	text-decoration: none;
}
-->
</style>
<br>

<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
}
.style1 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000000;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style7 {color: #FFFFFF}
.style9 {font-size: 9px}
.style10 {color: #000000}
.brdnoticia {border: 1px solid #000000;}
.style11 {font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; }
.style12 {font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; color: #FFFFFF; }
.style13 {color: #FFFFFF; font-size: 5px; }
.style17 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
a {
	font-weight: bold;
}
-->
</style>
</head>
<script language="JavaScript" src="banco_de_dados/java.js"></script>
<body>
<div id="Layer1" style="position:absolute; width:246px; height:238px; z-index:1; left: 1px; top: 0px;">
  <table width="500" height="339" border="0" cellpadding="0" cellspacing="0" bordercolor="#FF9900">
    <tr>
      <td align="center" valign="top" bordercolor="#000000" bgcolor="#000000"><table width="476" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
          <tr bgcolor="#FFFFFF">
            <td colspan="3" align="left" valign="top"><img src="imagens/ver/casa.jpg" width="500" height="100"></td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#FFFFFF" class="style1">Confira os detalhes Sobre o Im&oacute;vel!</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top" bgcolor="#FFFFFF" class="style11">-----------------------------------------------------------------------------------------------------------------------------</td>
          </tr>
          <tr>
            <td width="349" height="173" align="left" valign="top" bgcolor="#FFFFFF"><div align="center">
              <p class="style6"><br>
                  <%=(Rs_imovel.Fields.Item("materia").Value)%></p>
              </div></td>
            <td width="4" rowspan="2" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            <td width="147" rowspan="2" align="left" valign="top" bgcolor="#FFFFFF"><div align="center">
              <% 
While ((Repeat1__numRows <> 0) AND (NOT Fotos.EOF)) 
%>
              <table width="130" height="150" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                  <tr>
                    <td height="17" align="center" valign="middle" background="imagens/ilus_destaquebg.gif" bgcolor="#FFFFFF"><img src="imagens/ilus_destaquetop.gif" width="141" height="17"></td>
                  </tr>
                  <tr>
                    <td width="127" height="85" align="center" valign="middle" background="imagens/ilus_destaquebg.gif" bgcolor="#FFFFFF"><div align="center"><span class="style7"><a href="javascript:openPictureWindow_Fever('fotos/casa/<%=(Fotos.Fields.Item("arquivo").Value)%>','<%=(Fotos.Fields.Item("largura").Value)%>','<%=(Fotos.Fields.Item("altura").Value)%>','kiuchi','10','10')"><img src="fotos/casa/casa_<%=(Fotos.Fields.Item("arquivo").Value)%>" width="100" height="75" border="1" align="middle" class="brdnoticia" bordercolor="#000000"></a></span></div></td>
                  </tr>
                  <tr>
                    <td background="imagens/ilus_destaquebg.gif" class="style7 style9"><div align="center" class="style2 style10"><%=(Fotos.Fields.Item("descricao").Value)%></div></td>
                  </tr>
                  <tr>
                    <td height="20" background="imagens/ilus_destaquebg.gif" class="style7 style9"><span class="style10"><span class="style2">Foto:<%=(Fotos.Fields.Item("fotografo").Value)%></span></span></td>
                  </tr>
                  <tr>
                    <td height="8" align="center" valign="top" class="style7 style9"><img src="imagens/linha_pontilhadoaz_hor.gif" width="141" height="8"></td>
                  </tr>
                  <tr>
                    <td height="5" valign="middle" class="style13">--</td>
                  </tr>
                </table>
              <% 
  Repeat1__index=Repeat1__index+1
  Repeat1__numRows=Repeat1__numRows-1
  Fotos.MoveNext()
Wend
%>
</div></td>
          </tr>
          <tr>
            <td height="173" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style17">Deseja Obter este im&oacute;vel?<br>
              Ligue para: 


 (21) 2734-2431<br>
              ou<br>
              Mande um e-mail <a href="mailto:contato@kiuchiimobiliaria.com.br">clicando aqui</a>, nos informando o c&oacute;digo do Im&oacute;vel
            </span>              <table width="196" border="2" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#35C3D7"><tr>
                <th width="190" class="style1" scope="col">C&oacute;digo:<%=(Rs_imovel.Fields.Item("data").Value)%></th>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#35C3D7">
            <td colspan="3">
                <div align="center"><span class="style12"><span class="style2 style17">Todos Os Direitos Reservados - kiuchiimobiliaria Imobili&aacute;ria - Tel: (21) 2734-2431<br>
Rua Jo&atilde;o Carmo - 50 - Centro - Rio Bonito - RJ </span></span></div></td></tr>
      </table>        </td>
    </tr>
  </table>
</div>

</body>
</html>
<%
Rs_imovel.Close()
Set Rs_imovel = Nothing
%>
<%
Fotos.Close()
Set Fotos = Nothing
%>

