<?php require_once('../../Connections/CostaverdeFM.php'); ?>
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
$conn_CostaverdeFM = new KT_connection($CostaverdeFM, $database_CostaverdeFM);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../../fotos/");
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
  $uploadObj->setFolder("../../fotos/");
  $uploadObj->setResize("true", 320, 220);
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_noticias = new tNG_multipleInsert($conn_CostaverdeFM);
$tNGs->addTransaction($ins_noticias);
// Register triggers
$ins_noticias->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_noticias->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_noticias->registerTrigger("END", "Trigger_Default_Redirect", 99, "destaque_edite.php");
$ins_noticias->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_noticias->setTable("noticias");
$ins_noticias->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$ins_noticias->addColumn("materia", "STRING_TYPE", "POST", "materia");
$ins_noticias->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_noticias->addColumn("fonte", "STRING_TYPE", "POST", "fonte");
$ins_noticias->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$ins_noticias->addColumn("descricao_imagem", "STRING_TYPE", "POST", "descricao_imagem");
$ins_noticias->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_noticias = new tNG_multipleUpdate($conn_CostaverdeFM);
$tNGs->addTransaction($upd_noticias);
// Register triggers
$upd_noticias->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_noticias->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_noticias->registerTrigger("END", "Trigger_Default_Redirect", 99, "destaque_edite.php");
$upd_noticias->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_noticias->setTable("noticias");
$upd_noticias->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$upd_noticias->addColumn("materia", "STRING_TYPE", "POST", "materia");
$upd_noticias->addColumn("data", "STRING_TYPE", "POST", "data");
$upd_noticias->addColumn("fonte", "STRING_TYPE", "POST", "fonte");
$upd_noticias->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$upd_noticias->addColumn("descricao_imagem", "STRING_TYPE", "POST", "descricao_imagem");
$upd_noticias->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_noticias = new tNG_multipleDelete($conn_CostaverdeFM);
$tNGs->addTransaction($del_noticias);
// Register triggers
$del_noticias->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_noticias->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../includes/nxt/back.php");
$del_noticias->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_noticias->setTable("noticias");
$del_noticias->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsnoticias = $tNGs->getRecordset("noticias");
$row_rsnoticias = mysql_fetch_assoc($rsnoticias);
$totalRows_rsnoticias = mysql_num_rows($rsnoticias);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/painel.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Painel de Controle Costa Verde FM</title>
<!-- InstanceEndEditable -->
<link href="../../css/css.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEditableHeadTag -->
<link href="../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="8" bgcolor="#FFFFFF">
  <tr>
    <td height="81" colspan="3" align="left" valign="middle" bgcolor="#39D351"><img src="../topo.jpg" alt="Painel de Controle" width="775" height="120" /></td>
  </tr>
  <tr>
    <td width="206" height="389" align="center" valign="top" bgcolor="#3A9456"><table width="100%" border="0" cellpadding="0" cellspacing="2" id="menu_painel">
      
      <tr>
        <th height="32" align="center" class="titulo_anuncio style1" scope="col">Menu</th>
      </tr>
      <tr>
        <th height="32" align="center" class="titulo_anuncio style1" scope="col"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="home.php">Home</a></th>
          </tr>
        </table></th>
      </tr>
      
      
      <tr>
        <th align="left" scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Fotos </th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="foto_add.php">Inserir</a></th>
          </tr>
          <tr>
            <th scope="row"><a href="foto_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th align="left" scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Galerias</th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="galeria_add.php">Inserir</a></th>
          </tr>
          <tr>
            <th scope="row"><a href="galeria_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th align="left" scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Top 12 </th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          
          <tr>
            <th scope="row"><a href="top_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Mp3</th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="mp3_add.php">Inserir</a></th>
          </tr>
          <tr>
            <th scope="row"><a href="mp3_edite.php"> Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Recados</th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="row"><a href="recados_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Fique Ligado </th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="ligado_add.php">Inserir</a></th>
          </tr>
          <tr>
            <th scope="row"><a href="ligado_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Promo&ccedil;&otilde;es</th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="promo_add.php">Inserir</a></th>
          </tr>
          <tr>
            <th scope="row"><a href="promo_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Equipe</th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="equipe_add.php">Inserir</a></th>
          </tr>
          <tr>
            <th scope="row"><a href="equipe_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2" class="sessao_painel">
          <tr>
            <th scope="col">Programa</th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th scope="row"><table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th scope="col"><a href="programa_add.php">Inserir</a></th>
          </tr>
          <tr>
            <th scope="row"><a href="programa_edite.php">Modificar / Remover </a></th>
          </tr>
        </table></th>
      </tr>
    </table></td>
    <td width="594" colspan="2" align="left" valign="top"><!-- InstanceBeginEditable name="Conteudo" --><?php echo $tNGs->displayValidationRules();?>
        <script src="../../includes/nxt/scripts/form.js" type="text/javascript"></script>
      <script src="../../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
      <script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: false,
  show_as_grid: true,
  merge_down_value: true
}
        </script>
        
        <!-- TinyMCE-->
        <script language="javascript" type="text/javascript" src="../../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "simple",
	plugins : "emotions",
	
	theme_advanced_buttons3_add : "emotions,",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
	flash_external_list_url : "example_data/example_flash_list.js"
});
</script>

<!--FIM -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;
            <?php
	echo $tNGs->getErrorMsg();
?>
            <div class="KT_tng">
              <table width="100%" border="0" cellpadding="0" cellspacing="2" class="titulos">
                <tr>
                  <th height="27" align="left" scope="col">Inserir Destaque </th>
                </tr>
              </table>
              <div class="KT_tngform">
                <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
                  <?php $cnt1 = 0; ?>
                  <?php do { ?>
                    <?php $cnt1++; ?>
                    <?php 
// Show IF Conditional region1 
if (@$totalRows_rsnoticias > 1) {
?>
                      <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                      <?php } 
// endif Conditional region1
?>
                    <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                      <tr>
                        <td class="KT_th"><label for="titulo_<?php echo $cnt1; ?>">Titulo:</label></td>
                        <td><input type="text" name="titulo_<?php echo $cnt1; ?>" id="titulo_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnoticias['titulo']); ?>" size="32" maxlength="200" />
                            <?php echo $tNGs->displayFieldHint("titulo");?> <?php echo $tNGs->displayFieldError("noticias", "titulo", $cnt1); ?> </td>
                      </tr>
                      <tr>
                        <td class="KT_th"><label for="materia_<?php echo $cnt1; ?>">Materia:</label></td>
                        <td><textarea name="materia_<?php echo $cnt1; ?>" id="materia_<?php echo $cnt1; ?>" cols="50" rows="10"><?php echo KT_escapeAttribute($row_rsnoticias['materia']); ?></textarea>
                            <?php echo $tNGs->displayFieldHint("materia");?> <?php echo $tNGs->displayFieldError("noticias", "materia", $cnt1); ?> </td>
                      </tr>
                      <tr>
                        <td class="KT_th"><label for="data_<?php echo $cnt1; ?>">Data:</label></td>
                        <td><input type="text" name="data_<?php echo $cnt1; ?>" id="data_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnoticias['data']); ?>" size="20" maxlength="20" />
                            <?php echo $tNGs->displayFieldHint("data");?> <?php echo $tNGs->displayFieldError("noticias", "data", $cnt1); ?> </td>
                      </tr>
                      <tr>
                        <td class="KT_th"><label for="fonte_<?php echo $cnt1; ?>">Fonte:</label></td>
                        <td><input type="text" name="fonte_<?php echo $cnt1; ?>" id="fonte_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnoticias['fonte']); ?>" size="30" maxlength="30" />
                            <?php echo $tNGs->displayFieldHint("fonte");?> <?php echo $tNGs->displayFieldError("noticias", "fonte", $cnt1); ?> </td>
                      </tr>
                      <tr>
                        <td class="KT_th"><label for="imagem_<?php echo $cnt1; ?>">Imagem:</label></td>
                        <td><input type="file" name="imagem_<?php echo $cnt1; ?>" id="imagem_<?php echo $cnt1; ?>" size="32" />
                            <?php echo $tNGs->displayFieldError("noticias", "imagem", $cnt1); ?> </td>
                      </tr>
                      <tr>
                        <td class="KT_th"><label for="descricao_imagem_<?php echo $cnt1; ?>">Descri&ccedil;&atilde;o da imagem:</label></td>
                        <td><input type="text" name="descricao_imagem_<?php echo $cnt1; ?>" id="descricao_imagem_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnoticias['descricao_imagem']); ?>" size="32" maxlength="50" />
                            <?php echo $tNGs->displayFieldHint("descricao_imagem");?> <?php echo $tNGs->displayFieldError("noticias", "descricao_imagem", $cnt1); ?> </td>
                      </tr>
                    </table>
                    <input type="hidden" name="kt_pk_noticias_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsnoticias['kt_pk_noticias']); ?>" />
                    <?php } while ($row_rsnoticias = mysql_fetch_assoc($rsnoticias)); ?>
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
          <p>&nbsp;</p></td>
        </tr>
      </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td height="40" colspan="3" align="center" valign="middle" bgcolor="#3A9456"><span class="fonte11px_branca_negrito">Painel de Controle Desenvolvido por Victor Caetano e Ded&eacute; Siqueira </span></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
