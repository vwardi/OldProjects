<%
	'*******
	' A Simple, easy to navigate album. 
	' Developed by: Salman Quazi [admin@setcomputing.com]
	' January, 22nd 2002.
	'*******

	Dim album_FSO, album_list, img_id, item
	Dim dir_string,tmp
	Dim max_file

	response.write "<script type=""text/javascript"" src=""" & album_dir & "_system/script.js""></script>"
	Select Case (Request.QueryString("prv")) 
	
	Case ""	
		dir_string = album_dir & Request.QueryString("dir")
		set album_FSO = Server.CreateObject("Scripting.FileSystemObject")
		set album_list = album_FSO.GetFolder(Server.MapPath(dir_string))
		img_id=0
	
		For each item in album_list.SubFolders
				if (img_id = 0) AND ((InStr(1, item, "_vti", 1) = 0) And InStr(1, item, "_system", 1) = 0) then
					with(response) 
						.write "<form method=""get"" action=""" & album_dir & "album.asp"" name=""thumbnail""><div style=""font-size:medium;color: rgb(83,112,213);""><img src=""" & album_dir &"_system/images/pref.png"" align=""middle"" /> <b>" & welcome_text  &"</b></div><br /><img src=""" & album_dir & "_system/images/divider.gif" &""" /><br /><b>&nbsp;Options ::</b><p style=""margin-left:12pt"">"
						.write "<input type=""hidden"" name=""dir"" value="""" />"
						.write "<input type=""radio"" checked=""checked"" name=""prv"" value="""" />Normal<br />"
						.write "<input type=""radio"" name=""prv"" value=""y"" />Visualizar Miniaturas<br />"
						.write "<input type=""radio"" name=""prv"" value=""sld"" />Ver Como Slide Show&nbsp;"
						.write "<input onClick=""confirmChecked();"" type=""checkbox"" name=""rand"" value=""y"" />Random Animation</p>"
						.write "<img src=""" & album_dir & "_system/images/divider.gif" &""" /><br /><b>&nbsp;Albums ::</b><p style=""margin-left:16pt"">"
					end with
				end if
				If (InStr(1, item, "_vti", 1) = 0) And InStr(1, item, "_system", 1) = 0 Then
					response.write "<img src=""" & album_dir & "_system/images/folder.gif "" /> <a onMouseOver=""change_status('Go to album: " & item.name & "'); return true;"" onMouseOut=""window.status=''; return true;"" href=""javascript:AlbumClicked('" &  item.name & "');"" class=""album"">"
					response.write item.name & "</a><br />"
					img_id = img_id + 1
				end if
		Next
		set item = nothing
		set album_list = nothing
		set album_FSO = nothing
		
		if img_id = 0 then
			Dim dir_name, show_pic
			dir_name = Request.QueryString("dir")
		
			dir_string = album_dir & dir_name
			if Request.QueryString("Pr�xima_id") = "" then
				show_pic = "0"
			else
				show_pic = Request.QueryString("Pr�xima_id")
			end if
		
			set album_FSO = Server.CreateObject("Scripting.FileSystemObject")
			set album_list = album_FSO.GetFolder(Server.MapPath(dir_string))
			
			dim mark_num, img_dir_name
			img_id=0
			mark_num = 0
		
			img_dir_name = dir_name
			dir_name=Server.URLEncode(dir_name)
			For each item in album_list.Files
				tmp=Mid(item, Instr(item, "."))
				if (tmp<>".asp" AND tmp<>".htm" AND tmp<>".html" AND tmp<>".php" AND show_pic = (img_id&"")) then
					with(response) 
						.write "<center><div class=""shadow_image"">"
						.write "<img src=""" & album_dir & img_dir_name & "/" & item.name & """ border=""0"" alt=""Download time [28.8 modem] " & Round((item.Size/28800),2) & " sec. (approx.)"" /><p /></div>"
						.write "<font size=""1pt""><b>Foto " & (img_id+1) & "</b></font></center>"
					end with
					mark_num = img_id
				end if
				img_id = img_id+1
			Next 
			response.write "<table border=""0"" cellpadding=""0"" cellspacing=""0"" width=""100%"">"
			response.write "<tr>"
		
			if mark_num = 0 then
				response.write "<td width=""50%"" align=""left""></td>"
			ElseIf(Request.QueryString("dir")<>"") then
				response.write "<td width=""50%"" align=""left""><a onMouseover=""javascript:status_window(0); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_file & "?dir=" & dir_name & "&Pr�xima_id=" & mark_num-1 & "&max_pic=" & img_id & """><img src='" & album_dir & "_system/images/backarrow.gif' border='0'> Voltar Foto</a></td>"
			end if
					
			if ((mark_num+1)&"") = Request.QueryString("max_pic") then
				response.write "<td width=""50%"" align=""right""></td>"
			ElseIf(Request.QueryString("dir")<>"" AND (mark_num+1) <> img_id AND (mark_num+img_id+0)<>0) Then
				response.write "<td width=""50%"" align=""right""><a onMouseover=""javascript:status_window(1); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_file & "?dir=" & dir_name & "&Pr�xima_id=" & mark_num+1 & "&max_pic=" & img_id & """>Pr�xima Foto <img align=""middle"" src=""" & album_dir & "_system/images/nextarrow.gif"" border=""0"" /></a></td>"
			end if
						
			response.write "</tr>"
			response.write "</table>"
		
			set item = nothing
			set album_list = nothing
			set album_FSO = nothing
		end if

		if(Request.QueryString("dir") <> "") then
			with(response) 
				.write "<div align=""center"">"
				.write "<p />"
				.write "<table border=""0"" cellpadding=""0"" style=""border: 1 solid silver; border-style: dotted;"">"
				.write "<tr>"
				.write "<td>&nbsp;&nbsp;&nbsp;"
				.write "<a onMouseover=""javascript:status_window(2); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & """></a>"
			
				If ((mark_num+img_id+0)<>0) then
					if mark_num <> 0 then
						.write "  <a onMouseover=""javascript:status_window(3); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & album_file & "?dir=" & Request.QueryString("dir") & """>Primeira Foto</a>"
					end if
					if (((mark_num+1)&"") <> Request.QueryString("max_pic") AND (mark_num+1) <> img_id) then
						.write "  <a onMouseover=""javascript:status_window(4); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & album_file & "?dir=" & Request.QueryString("dir") & "&Pr�xima_id=" & img_id-1 & "&max_pic=" & img_id & """>�ltima Foto</a>"
					end if
					.write "  <a onMouseover=""javascript:status_window(5); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""javascript:window.location=jump_uri('" & album_dir & "','" & (mark_num+1) & "','" & Request.QueryString("dir") & "','" &  img_id & "');""></a>"
				end if
				.write " | <a href=""" & album_dir & album_file & "?dir=" & Request.QueryString("dir") & "&prv=y" & """ onMouseover=""javascript:status_window(6); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"">Visualizar Miniaturas</a> | "
					.write "<a onMouseover=""javascript:status_window(9); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & album_file & "?prv=sld&dir=" & Request.QueryString("dir") & """>Ver Como Slide Show</a>"
				.write "&nbsp;&nbsp;&nbsp;</td></tr></table></div>"
			end with
		else
			response.write "<br /></p></form>"
		end if
	Case "sld"
		if(Request.QueryString("dir") <> "") then
			dir_string = album_dir & Request.QueryString("dir")

			set album_FSO = Server.CreateObject("Scripting.FileSystemObject")
			set album_list = album_FSO.GetFolder(Server.MapPath(dir_string))
		
			img_dir_name = Request.QueryString("dir")
			dir_name=Server.URLEncode(dir_name)
			with(response)
				img_id=0
				// A loop to find the max, file
				max_file=0
				For each item in album_list.Files
					max_file=max_file+1
				Next
				
				.write "<script language=""JavaScript"" type=""text/javascript"">"
				.write "var slideShowSpeed =" & slideShowDelay & ";"
				.write "var length=" & max_file & ";"
				if (Request.QueryString("rand") = "y") then
					.write "var rand_anim_len=3;"
				else
					.write "var rand_anim_len=1;"
				end if
				.write "var t;"
				.write "var j = 0;"
				.write "var preLoad = new Array(" & max_file & ");"
				dim save_image
				For each item in album_list.Files						
					tmp=Mid(item, Instr(item, "."))

					if (tmp<>".asp" AND tmp<>".htm" AND tmp<>".html" AND tmp<>".php") then
						if(img_id=0)then 
							save_image= album_dir & img_dir_name & "/" & item.name
						end if
						.write "preLoad[" & img_id & "] = new Image();"
						.write "preLoad[" & img_id & "].src = '" & album_dir & img_dir_name & "/" & item.name & "';"
					end if
					img_id=img_id+1
				Next
				.write "var rand_anim = new Array(rand_anim_len);"
				.write "rand_anim[0] = "";"";"
				.write "rand_anim[1] = "");"";"
				.write "rand_anim[2] = "");"";"
					
				.write "</script><div align=""center"">"
				.write "<br /><br /><img src=""" & save_image &""" alt=""SlideShow"" name=""SlideShow"" />"
				.write "<p /><br /><br /><table border=""0"" cellpadding=""0"" style=""border: 1 solid silver; border-style: dotted;"">"
				.write "<tr>"
				.write "<td>&nbsp;&nbsp;&nbsp;"
				.write "<a onMouseover=""javascript:status_window(2); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & """></a>  "
				.write "<a onMouseover=""javascript:status_window(8); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & album_file & "?prv=y&dir=" & Request.QueryString("dir") & """>Visualizar Miniaturas</a> | "
				.write "<a onMouseover=""javascript:status_window(7); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & album_file & "?dir=" & Request.QueryString("dir") & """>Voltar Ao Modo Normal</a>&nbsp;&nbsp;&nbsp;"
				.write "</td></tr></table></div>"
				.write "<script type=""text/javascript"" language=""JavaScript"">runSlideShow();</script>"
			end with
			set album_list = nothing
			set album_FSO = nothing

		else
			response.write "<p />No Directory to thumbnail preview"
		end if
	Case "y"
		if(Request.QueryString("dir") <> "") then
			dir_string = album_dir & Request.QueryString("dir")

			set album_FSO = Server.CreateObject("Scripting.FileSystemObject")
			set album_list = album_FSO.GetFolder(Server.MapPath(dir_string))
		
			img_dir_name = Request.QueryString("dir")
			dir_name=Server.URLEncode(dir_name)
			with(response)
				.write "<table border=""0"" cellspacing=""2"" cellpadding=""2"">"
				.write "<tr>"
				img_id=0
				// A loop to find the max, file
				max_file=0
				For each item in album_list.Files
					max_file=max_file+1
				Next
				For each item in album_list.Files						
					tmp=Mid(item, Instr(item, "."))
					img_id=img_id+1

					if (tmp<>".asp" AND tmp<>".htm" AND tmp<>".html" AND tmp<>".php") then
						.write "<td align=""center""><a onMouseover=""change_status('Go to Foto: Foto " & img_id & "'); return true;"" onMouseOut=""window.status=''; return true;"" href=""" & album_dir & album_file & "?dir=" & img_dir_name & "&Pr�xima_id=" & (img_id-1) & "&max_pic=" & max_file & "&thmb=y""><img class=""trans"" onMouseOut=""out();"" onMouseOver=""over();"" & width=""100"" border=""0"" height=""70"" src=""" & album_dir & img_dir_name & "/" & item.name & """ /></a><br /><b><font size=""1pt"">Foto " & img_id & "</font></b></td>"
					end if
					if ((img_id Mod imgPerRow) =0) then
						.write "</tr><tr>"
					end if
				Next
				
				.write "</tr></table>"
				.write "<div align=""center"">"
				.write "<p /><br /><br /><table border=""0"" cellpadding=""0"" style=""border: 1 solid silver; border-style: dotted;"">"
				.write "<tr>"
				.write "<td>&nbsp;&nbsp;&nbsp;"
				.write "<a onMouseover=""javascript:status_window(2); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & """></a>  "
				.write "<a onMouseover=""javascript:status_window(9); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & album_file & "?prv=sld&dir=" & Request.QueryString("dir") & """>Ver Como Slide Show</a> | "
				.write "<a onMouseover=""javascript:status_window(7); return true;"" onMouseOut=""window.status=''; return true;"" class=""album"" href=""" & album_dir & album_file & "?dir=" & Request.QueryString("dir") & """>Voltar Ao Modo Normal</a>&nbsp;&nbsp;&nbsp;"
				.write "</td></tr></table></div>"
			end with
			set album_list = nothing
			set album_FSO = nothing
		else
			response.write "<p />No Directory to thumbnail preview"
		end if
	end select
%>