<html>
<head>
<script type="text/javascript">
function insRow()
{
var x=document.getElementById('myTable').insertRow(0)
var y=x.insertCell(0)
var z=x.insertCell(1)
y.innerHTML="NEW CELL1"
z.innerHTML="NEW CELL2"
}
</script>
</head>

<body>
<table id="myTable" border="1">
<tr>
<td>Row1 cell1</td>
<td>Row1 cell2</td>
</tr>
<tr>
<td>Row2 cell1</td>
<td>Row2 cell2</td>
</tr>
<tr>
<td>Row3 cell1</td>
<td>Row3 cell2</td>
</tr>
<tr>
<td>Row4 cell1</td>
<td>Row4 cell2</td>
</tr>
<tr>
<td>Row5 cell1</td>
<td>Row5 cell2</td>
</tr>
</table>
<form>
<input type="button" onclick="insRow()" value="Insert row">
</form>
</body>

</html>