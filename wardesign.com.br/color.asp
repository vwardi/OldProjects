<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="Connections/conex.asp" -->
<%
Dim RsVerNot
Dim RsVerNot_numRows

Set RsVerNot = Server.CreateObject("ADODB.Recordset")
RsVerNot.ActiveConnection = MM_conex_STRING
RsVerNot.Source = "SELECT * FROM noticias ORDER BY CodNoticia DESC"
RsVerNot.CursorType = 0
RsVerNot.CursorLocation = 2
RsVerNot.LockType = 1
RsVerNot.Open()

RsVerNot_numRows = 0
%>
<%
Dim Fotos
Dim Fotos_numRows

Set Fotos = Server.CreateObject("ADODB.Recordset")
Fotos.ActiveConnection = MM_conex_STRING
Fotos.Source = "SELECT * FROM fotos ORDER BY CodNoticia DESC"
Fotos.CursorType = 0
Fotos.CursorLocation = 2
Fotos.LockType = 1
Fotos.Open()

Fotos_numRows = 0
%>
              
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/sb.css">
<!--Code generated by Cool Web Scrollbars from Harmony Hollow Software-->
<!--http://www.harmonyhollow.net-->
<STYLE type="text/css">
<!--
BODY {
	scrollbar-face-color:#8CB1DB;
	scrollbar-highlight-color:#8CB1DB;
	scrollbar-3dlight-color:#8CB1DB;
	scrollbar-darkshadow-color:#8CB1DB;
	scrollbar-shadow-color:#8CB1DB;
	scrollbar-arrow-color:#ffffff;
	scrollbar-track-color:#8CB1DB;
	background-color: #8CB1DB;
}
.style1 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #ffffff;
}
body,td,th {
	color: #ffffff;
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
.style17 {font-size: 14px}
.style19 {color: #000000}
.style25 {	color: #0000FF;
	font-style: italic;
}
.style6 {color: #FFFFFF}
-->
</STYLE>
<!--End Cool Web Scrollbars code-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body>
<div align="center">
  <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th scope="col"><table width="416" cellpadding="0" cellspacing="0">
          <tr>
            <td width="15"><img src="figuras/retalhos/cantoesquerdo.gif" width="15" height="15"></td>
            <td width="384" height="15" bgcolor="#FFFFFF" class="style1">--</td>
            <td width="15" height="15"><img src="figuras/retalhos/cantodireito.gif" width="15" height="15"></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#FFFFFF"><table width="407" height="66" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td height="10" colspan="2" align="center" class="tit"><div align="left">
                      <p align="center" class="style16">&nbsp;<span class="style17">:: <%=(RsVerNot.Fields.Item("titulo").Value)%>::</span></p>
                  </div></td>
                </tr>
                <tr>
                  <td height="11" colspan="2" align="center" class="style23 style24"><%=(RsVerNot.Fields.Item("resumo").Value)%></td>
                </tr>
                <tr>
                  <td width="114" height="25" bgcolor="#FFFFFF"><span class="style19">Data: <strong><%=(RsVerNot.Fields.Item("data").Value)%></strong></span></td>
                  <% if (RsVerNot.Fields.Item("autmail").Value) <> ""then %>
                  <td width="184" align="right" bgcolor="#FFFFFF"><div align="center" class="style19">
                      <div align="right"><span class="mar">Por: </span><a href="mailto:<%=(RsVerNot.Fields.Item("autmail").Value)%>" class="style25"><%=(RsVerNot.Fields.Item("autor").Value)%> </a></div>
                  </div></td>
                  <% else %>
                  <td width="89" align="right" bgcolor="#FFFFFF"><div align="center" class="style19">
                      <div align="right">Por: <span class="style25"><%=(RsVerNot.Fields.Item("autor").Value)%></span></div>
                  </div></td>
                  <% end if %>
                </tr>
                <tr>
                  <td colspan="2" bgcolor="#FFFFFF" >
                    <div align="justify">
                      <% if  (Not Fotos.eof) then %>
                    </div>
                    <table width="200" border="5" align="right" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#F4F4F4">
                      <tr>
                        <td valign="top" bgcolor="#FFFFFF">
                          <% while (Not Fotos.eof) %>
                          <img src="images/spacer.gif" width="1" height="4" >
                          <table width="130" border="1" cellpadding="0" cellspacing="0" bordercolor="#55A5E2" bgcolor="#55A5E2">
                            <tr>
                              <td width="192" height="58" valign="top"><div align="center"><a href="javascript:openPictureWindow_Fever('fotos/<%=(Fotos.Fields.Item("arquivo").Value)%>','<%=(Fotos.Fields.Item("largura").Value)%>','<%=(Fotos.Fields.Item("altura").Value)%>','Foto - AT!TUDE','10','10')"><img src="fotos/foto_<%=(Fotos.Fields.Item("arquivo").Value)%>" width="120" height="90" border="0" align="absmiddle" class="borda"></a><span class="style6"><br>
                                        <%=(Fotos.Fields.Item("descricao").Value)%>
                                        <% If (Fotos.Fields.Item("fotografo").Value) <> "" then response.Write(" - Foto: ") End If%>
                                        <%=(Fotos.Fields.Item("fotografo").Value)%> </span></div></td>
                            </tr>
                          </table>
                          <% Fotos.MoveNext() 
Wend %></td>
                      </tr>
                    </table>
                    <% end if  %>
                    <% response.write replace((RsVerNot.Fields.Item("materia").Value), vbcrlf,"<br>")%></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="figuras/retalhos/cantodireitoesquerdo.gif" width="15" height="15"></td>
            <td bgcolor="#FFFFFF" class="style1">--</td>
            <td><img src="figuras/retalhos/cantodireitobaixo.gif" width="15" height="15"></td>
          </tr>
      </table></th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
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
