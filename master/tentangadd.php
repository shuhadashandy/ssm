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
$tentang_add = new tentang_add();

// Run the page
$tentang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tentang_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftentangadd = currentForm = new ew.Form("ftentangadd", "add");

// Validate form
ftentangadd.validate = function() {
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
		<?php if ($tentang_add->Judul->Required) { ?>
			elm = this.getElements("x" + infix + "_Judul");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tentang->Judul->caption(), $tentang->Judul->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tentang_add->Gambar->Required) { ?>
			felm = this.getElements("x" + infix + "_Gambar");
			elm = this.getElements("fn_x" + infix + "_Gambar");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $tentang->Gambar->caption(), $tentang->Gambar->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tentang_add->Isi->Required) { ?>
			elm = this.getElements("x" + infix + "_Isi");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tentang->Isi->caption(), $tentang->Isi->RequiredErrorMessage)) ?>");
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
ftentangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftentangadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tentang_add->showPageHeader(); ?>
<?php
$tentang_add->showMessage();
?>
<form name="ftentangadd" id="ftentangadd" class="<?php echo $tentang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tentang_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tentang_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tentang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tentang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tentang->Judul->Visible) { // Judul ?>
	<div id="r_Judul" class="form-group row">
		<label id="elh_tentang_Judul" for="x_Judul" class="<?php echo $tentang_add->LeftColumnClass ?>"><?php echo $tentang->Judul->caption() ?><?php echo ($tentang->Judul->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tentang_add->RightColumnClass ?>"><div<?php echo $tentang->Judul->cellAttributes() ?>>
<span id="el_tentang_Judul">
<input type="text" data-table="tentang" data-field="x_Judul" name="x_Judul" id="x_Judul" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($tentang->Judul->getPlaceHolder()) ?>" value="<?php echo $tentang->Judul->EditValue ?>"<?php echo $tentang->Judul->editAttributes() ?>>
</span>
<?php echo $tentang->Judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tentang->Gambar->Visible) { // Gambar ?>
	<div id="r_Gambar" class="form-group row">
		<label id="elh_tentang_Gambar" class="<?php echo $tentang_add->LeftColumnClass ?>"><?php echo $tentang->Gambar->caption() ?><?php echo ($tentang->Gambar->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tentang_add->RightColumnClass ?>"><div<?php echo $tentang->Gambar->cellAttributes() ?>>
<span id="el_tentang_Gambar">
<div id="fd_x_Gambar">
<span title="<?php echo $tentang->Gambar->title() ? $tentang->Gambar->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($tentang->Gambar->ReadOnly || $tentang->Gambar->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="tentang" data-field="x_Gambar" name="x_Gambar" id="x_Gambar"<?php echo $tentang->Gambar->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Gambar" id= "fn_x_Gambar" value="<?php echo $tentang->Gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x_Gambar" id= "fa_x_Gambar" value="0">
<input type="hidden" name="fs_x_Gambar" id= "fs_x_Gambar" value="50">
<input type="hidden" name="fx_x_Gambar" id= "fx_x_Gambar" value="<?php echo $tentang->Gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Gambar" id= "fm_x_Gambar" value="<?php echo $tentang->Gambar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Gambar" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $tentang->Gambar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tentang->Isi->Visible) { // Isi ?>
	<div id="r_Isi" class="form-group row">
		<label id="elh_tentang_Isi" for="x_Isi" class="<?php echo $tentang_add->LeftColumnClass ?>"><?php echo $tentang->Isi->caption() ?><?php echo ($tentang->Isi->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tentang_add->RightColumnClass ?>"><div<?php echo $tentang->Isi->cellAttributes() ?>>
<span id="el_tentang_Isi">
<textarea data-table="tentang" data-field="x_Isi" name="x_Isi" id="x_Isi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($tentang->Isi->getPlaceHolder()) ?>"<?php echo $tentang->Isi->editAttributes() ?>><?php echo $tentang->Isi->EditValue ?></textarea>
</span>
<?php echo $tentang->Isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tentang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tentang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tentang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tentang_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tentang_add->terminate();
?>