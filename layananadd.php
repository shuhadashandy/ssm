<?php
namespace PHPMaker2019\SsmPT;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$layanan_add = new layanan_add();

// Run the page
$layanan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$layanan_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var flayananadd = currentForm = new ew.Form("flayananadd", "add");

// Validate form
flayananadd.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($layanan_add->Judul->Required) { ?>
			elm = this.getElements("x" + infix + "_Judul");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $layanan->Judul->caption(), $layanan->Judul->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($layanan_add->Gambar->Required) { ?>
			felm = this.getElements("x" + infix + "_Gambar");
			elm = this.getElements("fn_x" + infix + "_Gambar");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $layanan->Gambar->caption(), $layanan->Gambar->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($layanan_add->Isi->Required) { ?>
			elm = this.getElements("x" + infix + "_Isi");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $layanan->Isi->caption(), $layanan->Isi->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
flayananadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flayananadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $layanan_add->showPageHeader(); ?>
<?php
$layanan_add->showMessage();
?>
<form name="flayananadd" id="flayananadd" class="<?php echo $layanan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($layanan_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $layanan_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="layanan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$layanan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($layanan->Judul->Visible) { // Judul ?>
	<div id="r_Judul" class="form-group row">
		<label id="elh_layanan_Judul" for="x_Judul" class="<?php echo $layanan_add->LeftColumnClass ?>"><?php echo $layanan->Judul->caption() ?><?php echo ($layanan->Judul->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $layanan_add->RightColumnClass ?>"><div<?php echo $layanan->Judul->cellAttributes() ?>>
<span id="el_layanan_Judul">
<input type="text" data-table="layanan" data-field="x_Judul" name="x_Judul" id="x_Judul" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($layanan->Judul->getPlaceHolder()) ?>" value="<?php echo $layanan->Judul->EditValue ?>"<?php echo $layanan->Judul->editAttributes() ?>>
</span>
<?php echo $layanan->Judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($layanan->Gambar->Visible) { // Gambar ?>
	<div id="r_Gambar" class="form-group row">
		<label id="elh_layanan_Gambar" class="<?php echo $layanan_add->LeftColumnClass ?>"><?php echo $layanan->Gambar->caption() ?><?php echo ($layanan->Gambar->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $layanan_add->RightColumnClass ?>"><div<?php echo $layanan->Gambar->cellAttributes() ?>>
<span id="el_layanan_Gambar">
<div id="fd_x_Gambar">
<span title="<?php echo $layanan->Gambar->title() ? $layanan->Gambar->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($layanan->Gambar->ReadOnly || $layanan->Gambar->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="layanan" data-field="x_Gambar" name="x_Gambar" id="x_Gambar"<?php echo $layanan->Gambar->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Gambar" id= "fn_x_Gambar" value="<?php echo $layanan->Gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x_Gambar" id= "fa_x_Gambar" value="0">
<input type="hidden" name="fs_x_Gambar" id= "fs_x_Gambar" value="50">
<input type="hidden" name="fx_x_Gambar" id= "fx_x_Gambar" value="<?php echo $layanan->Gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Gambar" id= "fm_x_Gambar" value="<?php echo $layanan->Gambar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Gambar" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $layanan->Gambar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($layanan->Isi->Visible) { // Isi ?>
	<div id="r_Isi" class="form-group row">
		<label id="elh_layanan_Isi" for="x_Isi" class="<?php echo $layanan_add->LeftColumnClass ?>"><?php echo $layanan->Isi->caption() ?><?php echo ($layanan->Isi->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $layanan_add->RightColumnClass ?>"><div<?php echo $layanan->Isi->cellAttributes() ?>>
<span id="el_layanan_Isi">
<textarea data-table="layanan" data-field="x_Isi" name="x_Isi" id="x_Isi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($layanan->Isi->getPlaceHolder()) ?>"<?php echo $layanan->Isi->editAttributes() ?>><?php echo $layanan->Isi->EditValue ?></textarea>
</span>
<?php echo $layanan->Isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$layanan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $layanan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $layanan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$layanan_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$layanan_add->terminate();
?>