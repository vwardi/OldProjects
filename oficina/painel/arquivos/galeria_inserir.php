<?php require_once('../../Connections/ConBD.php'); ?>
<?php
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
$query_RsGaleriasAdd = "Select * From galerias order by titulo";
$RsGaleriasAdd = mysql_query($query_RsGaleriasAdd, $ConBD) or die(mysql_error());
$row_RsGaleriasAdd = mysql_fetch_assoc($RsGaleriasAdd);
$totalRows_RsGaleriasAdd = mysql_num_rows($RsGaleriasAdd);

//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../");

// Make unified connection variable
$conn_ConBD = new KT_connection($ConBD, $database_ConBD);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../../uploads/");
  $deleteObj->setDbFieldName("imagem");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("imagem");
  $uploadObj->setDbFieldName("imagem");
  $uploadObj->setFolder("../../uploads/fotos/");
  $uploadObj->setResize("true", 134, 0);
  $uploadObj->setMaxSize(4000);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger
?>
<?php
// Make an insert transaction instance
$ins_galerias = new tNG_multipleInsert($conn_ConBD);
$tNGs->addTransaction($ins_galerias);
// Register triggers
$ins_galerias->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_galerias->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_galerias->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$ins_galerias->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_galerias->setTable("galerias");
$ins_galerias->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$ins_galerias->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_galerias->addColumn("descricao", "STRING_TYPE", "POST", "descricao");
$ins_galerias->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$ins_galerias->addColumn("galeriaID", "STRING_TYPE", "POST", "galeriaID");
$ins_galerias->setPrimaryKey("id", "NUMERIC_TYPE");
?>
<?php
// Make an update transaction instance
$upd_galerias = new tNG_multipleUpdate($conn_ConBD);
$tNGs->addTransaction($upd_galerias);
// Register triggers
$upd_galerias->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_galerias->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_galerias->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$upd_galerias->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_galerias->setTable("galerias");
$upd_galerias->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$upd_galerias->addColumn("data", "STRING_TYPE", "POST", "data");
$upd_galerias->addColumn("descricao", "STRING_TYPE", "POST", "descricao");
$upd_galerias->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$upd_galerias->addColumn("galeriaID", "STRING_TYPE", "POST", "galeriaID");
$upd_galerias->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");
?>
<?php
// Make an instance of the transaction object
$del_galerias = new tNG_multipleDelete($conn_ConBD);
$tNGs->addTransaction($del_galerias);
// Register triggers
$del_galerias->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_galerias->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$del_galerias->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_galerias->setTable("galerias");
$del_galerias->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");
?><?php
// Execute all the registered transactions
$tNGs->executeTransactions();
?><?php
// Get the transaction recordset
$rsgalerias = $tNGs->getRecordset("galerias");
$row_rsgalerias = mysql_fetch_assoc($rsgalerias);
$totalRows_rsgalerias = mysql_num_rows($rsgalerias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/painel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Painel Administrativo </title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEditableHeadTag -->
<!-- InstanceEndEditable -->
<link href="../css.css" rel="stylesheet" type="text/css" />
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(../../img/bg_01.gif);
	background-color: #009CE7;
}
.style2 {
	color: #008BE1;
	font-size: 16px;
	font-weight: bold;
}
-->
</style></head>

<body>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><img src="topo.jpg" alt="Painel Administrativo" width="850" height="80" /></td>
  </tr>
  <tr>
    <td width="242" align="left" valign="top" bgcolor="#FFFFFF"><table width="250" height="100%" border="0" cellpadding="4" cellspacing="2">
      <tr>
        <td bgcolor="#DEE7F8" class="style2">Menu</td>
      </tr>
      <tr>
        <td class="titulo">Novidades</td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8" class="txt_06"><a href="novidade_inserir.php" class="txt_06">Inserir  </a></td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8" class="txt_06"><a href="novidade_edite.php" class="txt_06">Editar/Excluir </a></td>
      </tr>
      
      <tr>
        <td class="titulo">Galeria de Fotos </td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="galeria_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="galeria_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Fotos</td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="foto_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="foto_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">V&iacute;deos</td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="video_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="video_edite.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Agenda</td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="agenda_inserir.php">Inserir </a></td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="agenda_editar.php">Editar/Excluir</a></td>
      </tr>
      <tr>
        <td class="titulo">Logout</td>
      </tr>
      <tr>
        <td bgcolor="#DEE7F8"><a href="<?php echo $logoutAction ?>">Sair</a></td>
      </tr>
      

    </table></td>
    <td width="600" align="left" valign="top" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="conteudo" --><link href="../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" /><script src="../../includes/common/js/base.js" type="text/javascript"></script><script src="../../includes/common/js/utility.js" type="text/javascript"></script><script src="../../includes/skins/style.js" type="text/javascript"></script><?php echo $tNGs->displayValidationRules();?><script src="../../includes/nxt/scripts/form.js" type="text/javascript"></script><script src="../../includes/nxt/scripts/form.js.php" type="text/javascript"></script><script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: false,
  show_as_grid: false,
  merge_down_value: false
}
</script>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="titulo">Inseir Galeria</td>
        </tr>
        <tr>
          <td>&nbsp;
<?php
	echo $tNGs->getErrorMsg();
?>
<div class="KT_tng">
  <div class="KT_tngform"><form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
    <?php $cnt1 = 0; ?>
      <?php do { ?>
      <?php $cnt1++; ?>
      <?php 
// Show IF Conditional region1 
if (@$totalRows_rsgalerias > 1) {
?>
      <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
      <?php } 
// endif Conditional region1
?>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <tr>
          <td class="KT_th"><label for="titulo_<?php echo $cnt1; ?>">Titulo:</label></td>
          <td><input type="text" name="titulo_<?php echo $cnt1; ?>" id="titulo_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsgalerias['titulo']); ?>" size="32" maxlength="255" />
              <?php echo $tNGs->displayFieldHint("titulo");?> <?php echo $tNGs->displayFieldError("galerias", "titulo", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="data_<?php echo $cnt1; ?>">Data:</label></td>
          <td><input type="text" name="data_<?php echo $cnt1; ?>" id="data_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsgalerias['data']); ?>" size="10" maxlength="10" />
              <?php echo $tNGs->displayFieldHint("data");?> <?php echo $tNGs->displayFieldError("galerias", "data", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="descricao_<?php echo $cnt1; ?>">Descri&ccedil;&atilde;o:</label></td>
          <td><input type="text" name="descricao_<?php echo $cnt1; ?>" id="descricao_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsgalerias['descricao']); ?>" size="50" maxlength="200" />
              <?php echo $tNGs->displayFieldHint("descricao");?> <?php echo $tNGs->displayFieldError("galerias", "descricao", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="imagem_<?php echo $cnt1; ?>">Imagem:</label></td>
          <td><input type="file" name="imagem_<?php echo $cnt1; ?>" id="imagem_<?php echo $cnt1; ?>" size="32" />
              <?php echo $tNGs->displayFieldError("galerias", "imagem", $cnt1); ?> </td>
        </tr>
        <tr>
          <td class="KT_th"><label for="galeriaID_<?php echo $cnt1; ?>">Anexar &agrave; galeria::</label></td>
          <td><select name="galeriaID_<?php echo $cnt1; ?>" id="galeriaID_<?php echo $cnt1; ?>">
            <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
            <?php 
do {  
?>
            <option value="<?php echo $row_RsGaleriasAdd['id']?>"<?php if (!(strcmp($row_RsGaleriasAdd['id'], $row_rsgalerias['galeriaID']))) {echo "SELECTED";} ?>><?php echo $row_RsGaleriasAdd['titulo']?></option>
            <?php
} while ($row_RsGaleriasAdd = mysql_fetch_assoc($RsGaleriasAdd));
  $rows = mysql_num_rows($RsGaleriasAdd);
  if($rows > 0) {
      mysql_data_seek($RsGaleriasAdd, 0);
	  $row_RsGaleriasAdd = mysql_fetch_assoc($RsGaleriasAdd);
  }
?>
          </select>
              <?php echo $tNGs->displayFieldError("galerias", "galeriaID", $cnt1); ?> </td>
        </tr>
      </table>
      <input type="hidden" name="kt_pk_galerias_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsgalerias['kt_pk_galerias']); ?>" />
      <?php } while ($row_rsgalerias = mysql_fetch_assoc($rsgalerias)); ?>
      <div class="KT_bottombuttons">
        <div>
          <?php 
      // Show IF Conditional region1
      if (@$_GET['id'] == "") {
      ?>
          <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
          <?php 
      // else Conditional region1
      } else { ?>
          <div class="KT_operations">
            <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id')" />
          </div>
          <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
          <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
          <?php }
      // endif Conditional region1
      ?>
          <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../../includes/nxt/back.php')" />
        </div>
      </div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</td>
        </tr>
      </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RsGaleriasAdd);
?>
