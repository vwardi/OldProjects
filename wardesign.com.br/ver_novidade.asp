<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="Connections/conex.asp" -->
<%
Dim RsVerNot__MMColParam
RsVerNot__MMColParam = "1"
If (Request.QueryString("CodNot") <> "") Then 
  RsVerNot__MMColParam = Request.QueryString("CodNot")
End If
%>
<%
Dim RsVerNot
Dim RsVerNot_numRows

Set RsVerNot = Server.CreateObject("ADODB.Recordset")
RsVerNot.ActiveConnection = MM_conex_STRING
RsVerNot.Source = "SELECT * FROM noticias WHERE CodNoticia = " + Replace(RsVerNot__MMColParam, "'", "''") + " ORDER BY CodNoticia DESC"
RsVerNot.CursorType = 0
RsVerNot.CursorLocation = 2
RsVerNot.LockType = 1
RsVerNot.Open()

RsVerNot_numRows = 0
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
Fotos.ActiveConnection = MM_conex_STRING
Fotos.Source = "SELECT * FROM fotos WHERE CodNoticia = " + Replace(Fotos__MMColParam, "'", "''") + " ORDER BY CodNoticia DESC"
Fotos.CursorType = 0
Fotos.CursorLocation = 2
Fotos.LockType = 1
Fotos.Open()

Fotos_numRows = 0
%>
              
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/sb.css">
<script language="JavaScript" src="banco_de_dados/java.js"></script>
<!--Code generated by Cool Web Scrollbars from Harmony Hollow Software-->
<!--http://www.harmonyhollow.net-->
<STYLE type="text/css">
<!--
BODY {
	scrollbar-face-color:#55A5E2;
	scrollbar-highlight-color:#55A5E2;
	scrollbar-3dlight-color:#55A5E2;
	scrollbar-darkshadow-color:#55A5E2;
	scrollbar-shadow-color:#55A5E2;
	scrollbar-arrow-color:#ffffff;
	scrollbar-track-color:#55A5E2;
	background-color:#55A5E2;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #ffffff;
}
body,td,th {
	color: #ffffff;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
a:hover {
	color: #ffffff;
}
h1 {
	color: #ffffff;
}
a:link {
	color: #FFFFFF;
}
a:visited {
	color: #FFFFFF;
}
a:active {
	color: #FFFFFF;
}
.borda {border: 1px solid #000000;}
.style16 {font-size: 12;
	font-weight: bold;
	color: #000000;
}
.style19 {color: #000000}
.style6 {color: #FFFFFF}
.style26 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #ffffff; font-weight: bold; }
.style29 {color: #000000; font-weight: bold; }
.style30 {font-size: 12px}
.style31 {font-style: italic; text-transform: capitalize; color: #FF0000; text-decoration: underline; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style33 {
	font-size: 30px;
	color: #000066;
}
.style35 {color: #0066CC}
-->
</STYLE>
<!--End Cool Web Scrollbars code-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body>
<div align="center">
  <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th scope="col"><table width="477" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td height="15" class="style1"><img src="figuras/topo_news.jpg" width="450" height="70"></td>
            <td height="15">&nbsp;</td>
          </tr>
          <tr>
            <td width="15"><img src="figuras/retalhos/cantoesquerdo.gif" width="15" height="15"></td>
            <td width="445" height="15" bgcolor="#FFFFFF" class="style1">--</td>
            <td width="15" height="15"><img src="figuras/retalhos/cantodireito.gif" width="15" height="15"></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#FFFFFF"><table width="464" height="302" border="0" align="center" cellpadding="0" cellspacing="0" background="figuras/fundo_news.gif">
                <tr bgcolor="#FFFFFF">
                  <td height="10" colspan="3" align="center" class="tit"><div align="left">
                      <p align="center" class="style16 style33 style35">&nbsp;::<%=(RsVerNot.Fields.Item("titulo").Value)%>::</p>
                  </div></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td height="11" colspan="3" align="center" class="style19"><strong><%=(RsVerNot.Fields.Item("resumo").Value)%></strong></td>
                </tr>
                <tr>
                  <td width="175" height="46" class="style19"><span class="style30"><strong>Data:</strong> <em><%=(RsVerNot.Fields.Item("data").Value)%></em></span></td>
                  
                  <td width="266" align="center"><div align="right" class="style30"><span class="style29">Autor: </span><span class="style31"><%=(RsVerNot.Fields.Item("autor").Value)%></span></div></td>
                  
                  <td width="3" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" >
                    <div align="justify">
                      <% if  (Not Fotos.eof) then %>
                    </div>
                    <table width="146" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="150" align="right" valign="top">
                          <% while (Not Fotos.eof) %>
                          <img src="images/spacer.gif" width="1" height="4" >
                          <table width="130" border="1" cellpadding="0" cellspacing="0" bordercolor="#55A5E2" bgcolor="#55A5E2">
                            <tr>
                              <td width="192" height="58" valign="top"><div align="center"><a href="javascript:openPictureWindow_Fever('fotos/<%=(Fotos.Fields.Item("arquivo").Value)%>','<%=(Fotos.Fields.Item("largura").Value)%>','<%=(Fotos.Fields.Item("altura").Value)%>','Foto - NEWS','10','10')"><img src="fotos/foto_<%=(Fotos.Fields.Item("arquivo").Value)%>" width="120" height="90" border="0" align="absmiddle" class="borda"></a><span class="style6"><br>
                                        </span><span class="style26"><%=(Fotos.Fields.Item("descricao").Value)%><br>
                                        <% If (Fotos.Fields.Item("fotografo").Value) <> "" then response.Write("  Foto: ") End If%>
                                        <%=(Fotos.Fields.Item("fotografo").Value)%></span> </div></td>
                            </tr>
                          </table>
                          
                          <div align="right"></div>
                          <div align="right">
                            <% Fotos.MoveNext() 
Wend %>
                        </div></td>
                      </tr>
                    </table>
                    <span class="style16">
                    <% end if  %>
                    <% response.write replace((RsVerNot.Fields.Item("materia").Value), vbcrlf,"<br>")%>
                  </span></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="figuras/retalhos/cantodireitoesquerdo.gif" width="15" height="15"></td>
            <td bgcolor="#FFFFFF" class="style1">--</td>
            <td><img src="figuras/retalhos/cantodireitobaixo.gif" width="15" height="15"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td bgcolor="#55A5E2" class="style1"><div align="right">Criado por : Wardesign.com.br </div></td>
            <td>&nbsp;</td>
          </tr>
      </table></th>
    </tr>
  </table>
</div>
</body>
</html>
<%
RsVerNot.Close()
Set RsVerNot = Nothing
%>
<%
Fotos.Close()
Set Fotos = Nothing
%>
