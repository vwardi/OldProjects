<!-- #include file="connectionstring.asp" -->
              
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
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
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
-->
</STYLE>
<!--End Cool Web Scrollbars code-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body>
<span class="style1">
<%
dim sql
dim CS
dim RS
dim x

' objects
Set CS = Server.CreateObject("ADODB.Connection")
Set RS = Server.CreateObject("ADODB.Recordset")

' connection string (info in connectionstring.asp)
CS.ConnectionString = dbasepath
CS.Provider = provider
CS.Open

sql = "SELECT TOP 50 * FROM shoutbox ORDER BY postID DESC"

Set RS = CS.Execute(sql)

Response.Write "<p align=left>"

while RS.EOF = false
 
	Response.Write "<strong>" & RS("name") & "</strong>"
	Response.Write "<br><hr size=1 noshade color=#8CB1DB>"
	Response.Write "<strong><em>Mensagem</em></strong>"
    Response.Write "<br>"
	Response.Write "" & RS("post") & ""
	Response.Write "<br>"
	Response.Write "<br>"	
	Response.Write "<em>" & RS("pdate") & "</em>"
	Response.Write "<br><hr size=2 noshade color=#fffff>"
	
	RS.MoveNext
	
wend
 
Response.Write "</p>"
%>
</span>
</body>
</html>
