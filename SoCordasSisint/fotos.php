<?php require_once('Connections/ConBD.php'); ?>
<?php
// Load the common classes
require_once('includes/common/KT_common.php');

// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");

// Make unified connection variable
$conn_ConBD = new KT_connection($ConBD, $database_ConBD);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("Filedata");
  $uploadObj->setDbFieldName("arquivo");
  $uploadObj->setFolder("uploads/");
  $uploadObj->setMaxSize(2000);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

//start Trigger_Redirect trigger
//remove this line if you want to edit the code by hand
function Trigger_Redirect(&$tNG) {
  $redObj = new tNG_Redirect($tNG);
  $redObj->setURL(KT_getFullUri());
  $redObj->setKeepURLParams(false);
  return $redObj->Execute();
}
//end Trigger_Redirect trigger

// Make an insert transaction instance
$ins_fotos = new tNG_insert($conn_ConBD);
$tNGs->addTransaction($ins_fotos);
// Register triggers
$ins_fotos->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_fotos->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_fotos->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "FILES", "Filedata");
$ins_fotos->registerConditionalTrigger("{GET.isFlash} != 1", "END", "Trigger_Redirect", 90);
$ins_fotos->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$ins_fotos->registerConditionalTrigger("{GET.isFlash} == 1", "ERROR", "Trigger_Default_MUploadError", 10);
// Add columns
$ins_fotos->setTable("fotos");
$ins_fotos->addColumn("galeriaID", "STRING_TYPE", "VALUE", "");
$ins_fotos->addColumn("descricao", "STRING_TYPE", "VALUE", "");
$ins_fotos->addColumn("arquivo", "FILE_TYPE", "FILES", "Filedata");
$ins_fotos->setPrimaryKey("fotoID", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsfotos = $tNGs->getRecordset("fotos");
$row_rsfotos = mysql_fetch_assoc($rsfotos);
$totalRows_rsfotos = mysql_num_rows($rsfotos);

// Multiple Upload Helper Object
$muploadHelper = new tNG_MuploadHelper("", 32);
$muploadHelper->setMaxSize(2000);
$muploadHelper->setMaxNumber(0);
$muploadHelper->setExistentNumber(0);
$muploadHelper->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="includes/common/js/base.js" type="text/javascript"></script>
<script src="includes/common/js/utility.js" type="text/javascript"></script>
<script src="includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?><?php echo $muploadHelper->getScripts(); ?>
</head>

<body>
<table width="500" border="1" cellpadding="4" cellspacing="4" bordercolor="#CCCCCC">
  <tr>
    <td bgcolor="#CCCCCC">Inserir Fotos</td>
  </tr>
  <tr>
    <td><?php
// Multiple Upload Helper
echo $tNGs->getSavedErrorMsg();
echo $muploadHelper->Execute();
?>
      <?php
	echo $tNGs->getErrorMsg();
?></td>
  </tr>
  <tr>
    <td><a href="listar.php">Listar  Fotos</a></td>
  </tr>
</table>
</body>
</html>
