<?php require_once('../../Connections/fotos.php'); ?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');
?><?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../");

// Make unified connection variable
$conn_fotos = new KT_connection($fotos, $database_fotos);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../../design/");
  $deleteObj->setDbFieldName("arquivo");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("arquivo");
  $uploadObj->setDbFieldName("arquivo");
  $uploadObj->setFolder("../../design/");
  $uploadObj->setMaxSize(1000);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_design = new tNG_multipleInsert($conn_fotos);
$tNGs->addTransaction($ins_design);
// Register triggers
$ins_design->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_design->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_design->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$ins_design->registerTrigger("AFTER", "Trigger_ImageUpload", 98);
// Add columns
$ins_design->setTable("design");
$ins_design->addColumn("descricao", "STRING_TYPE", "POST", "descricao");
$ins_design->addColumn("autor", "STRING_TYPE", "POST", "autor");
$ins_design->addColumn("arquivo", "FILE_TYPE", "FILES", "arquivo");
$ins_design->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_design = new tNG_multipleUpdate($conn_fotos);
$tNGs->addTransaction($upd_design);
// Register triggers
$upd_design->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_design->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_design->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$upd_design->registerTrigger("AFTER", "Trigger_ImageUpload", 98);
// Add columns
$upd_design->setTable("design");
$upd_design->addColumn("descricao", "STRING_TYPE", "POST", "descricao");
$upd_design->addColumn("autor", "STRING_TYPE", "POST", "autor");
$upd_design->addColumn("arquivo", "FILE_TYPE", "FILES", "arquivo");
$upd_design->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_design = new tNG_multipleDelete($conn_fotos);
$tNGs->addTransaction($del_design);
// Register triggers
$del_design->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_design->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$del_design->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_design->setTable("design");
$del_design->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsdesign = $tNGs->getRecordset("design");
$row_rsdesign = mysql_fetch_assoc($rsdesign);
$totalRows_rsdesign = mysql_num_rows($rsdesign);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/painel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Painel de Controle - Real Fotos &amp; Design</title>
<!-- InstanceEndEditable -->
<link href="../../stilo.css" rel="stylesheet" type="text/css" />
<link href="painel.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEditableHeadTag -->
<link href="../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
</head>

<body>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="700" border="1" cellpadding="0" cellspacing="2" bordercolor="#313639">
      
      <tr>
        <th height="46" colspan="2" align="center" valign="middle" bgcolor="#313639" scope="row"><img src="img/topo2.jpg" width="600" height="80" /></th>
        </tr>
      <tr>
        <th width="153" height="501" align="center" valign="top" bgcolor="#313639" scope="row"><table width="100%" border="0" cellpadding="2" cellspacing="4" id="navigation">
          
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Galeria</th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="galeria_add.php">Adicionar</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="galeria_edite.php">Editar/Excluir</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Foto</th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="foto_add.php">Adicionar</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="foto_edite.php">Editar/Excluir</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Local</th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="local_add.php">Adicionar</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="local_edite.php">Editar/Excluir</a></th>
          </tr>
          
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Fot&oacute;grafo</th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="fotografo_add.php">Adicionar</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="fotografo_edite.php">Editar/Excluir</a></th>
          </tr>
          
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Design</th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="design_add.php">Adicionar</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="design_edite.php">Editar/Excluir</a></th>
          </tr>
          
          
          
          
          
          
          
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Coment&aacute;rios</th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="comentarios_aprovar.php">Aprovar/Excluir</a></th>
          </tr>
          
          
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Usu&aacute;rio</th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="user_add.php">Adicionar</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row"><a href="user_edite.php">Editar/Excluir</a></th>
          </tr>
          
          <tr>
            <th align="left" valign="middle" class="titulo_menu" scope="row">Logout</th>
          </tr>
          <tr>
            <th align="center" valign="middle" class="Titulo_galeria" scope="row"><a href="http://www.realfotos.com.br">Sair</a></th>
          </tr>
          <tr>
            <th align="left" valign="middle" scope="row">&nbsp;</th>
          </tr>
          
        </table></th>
        <td width="541" align="left" valign="top"><!-- InstanceBeginEditable name="conteudo" --><?php echo $tNGs->displayValidationRules();?>
            <script src="../../includes/nxt/scripts/form.js" type="text/javascript"></script>
            <script src="../../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
            <script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: false,
  show_as_grid: true,
  merge_down_value: false
}
            </script>
          <table width="100%" border="0" cellspacing="2" cellpadding="4">
            
            <tr>
              <th align="left" scope="col">&nbsp;
                <?php
	echo $tNGs->getErrorMsg();
?>
                <div class="KT_tng">
                  <h1 class="Titulo_galeria">
                    <?php 
// Show IF Conditional region1 
if (@$_GET['id'] == "") {
?>
                      <?php echo NXT_getResource("Insert_FH"); ?>
                      <?php 
// else Conditional region1
} else { ?>
                      <?php echo NXT_getResource("Update_FH"); ?>
                      <?php } 
// endif Conditional region1
?>
                    Design </h1>
                  <div class="KT_tngform">
                    <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
                      <?php $cnt1 = 0; ?>
                      <?php do { ?>
                        <?php $cnt1++; ?>
                        <?php 
// Show IF Conditional region1 
if (@$totalRows_rsdesign > 1) {
?>
                          <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                          <?php } 
// endif Conditional region1
?>
                        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                          <tr>
                            <td class="KT_th"><label for="descricao_<?php echo $cnt1; ?>">Descricao:</label></td>
                            <td><textarea name="descricao_<?php echo $cnt1; ?>" id="descricao_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsdesign['descricao']); ?></textarea>
                                <?php echo $tNGs->displayFieldHint("descricao");?> <?php echo $tNGs->displayFieldError("design", "descricao", $cnt1); ?> </td>
                          </tr>
                          <tr>
                            <td class="KT_th"><label for="autor_<?php echo $cnt1; ?>">Autor:</label></td>
                            <td><input type="text" name="autor_<?php echo $cnt1; ?>" id="autor_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsdesign['autor']); ?>" size="32" maxlength="50" />
                                <?php echo $tNGs->displayFieldHint("autor");?> <?php echo $tNGs->displayFieldError("design", "autor", $cnt1); ?> </td>
                          </tr>
                          <tr>
                            <td class="KT_th"><label for="arquivo_<?php echo $cnt1; ?>">Arquivo:</label></td>
                            <td><input type="file" name="arquivo_<?php echo $cnt1; ?>" id="arquivo_<?php echo $cnt1; ?>" size="32" />
                                <?php echo $tNGs->displayFieldError("design", "arquivo", $cnt1); ?> </td>
                          </tr>
                        </table>
                        <input type="hidden" name="kt_pk_design_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsdesign['kt_pk_design']); ?>" />
                        <?php } while ($row_rsdesign = mysql_fetch_assoc($rsdesign)); ?>
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
                <p>&nbsp;</p></th>
            </tr>
            <tr>
              <th align="left" scope="col">&nbsp;</th>
            </tr>
          </table>
        <!-- InstanceEndEditable --></td>
      </tr>
      <tr>
        <th height="37" colspan="2" bgcolor="#313639" scope="row">&nbsp;</th>
        </tr>
    </table></th>
  </tr>
</table>
</body><!-- InstanceEnd -->
</html>
