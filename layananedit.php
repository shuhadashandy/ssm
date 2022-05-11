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
$layanan_edit = new layanan_edit();

// Run the page
$layanan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$layanan_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var flayananedit = currentForm = new ew.Form("flayananedit", "edit");

// Validate form
flayananedit.validate = function() {
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
		<?php if ($layanan_edit->Judul->Required) { ?>
			elm = this.getElements("x" + infix + "_Judul");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $layanan->Judul->caption(), $layanan->Judul->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($layanan_edit->Gambar->Required) { ?>
			felm = this.getElements("x" + infix + "_Gambar");
			elm = this.getElements("fn_x" + infix + "_Gambar");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $layanan->Gambar->caption(), $layanan->Gambar->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($layanan_edit->Isi->Required) { ?>
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
flayananedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flayananedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $layanan_edit->showPageHeader(); ?>
<?php
$layanan_edit->showMessage();
?>
<?php if (!$layanan_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($layanan_edit->Pager)) $layanan_edit->Pager = new PrevNextPager($layanan_edit->StartRec, $layanan_edit->DisplayRecs, $layanan_edit->TotalRecs, $layanan_edit->AutoHidePager) ?>
<?php if ($layanan_edit->Pager->RecordCount > 0 && $layanan_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($layanan_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($layanan_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $layanan_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($layanan_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($layanan_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $layanan_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="flayananedit" id="flayananedit" class="<?php echo $layanan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($layanan_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $layanan_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="layanan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$layanan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($layanan->Judul->Visible) { // Judul ?>
	<div id="r_Judul" class="form-group row">
		<label id="elh_layanan_Judul" for="x_Judul" class="<?php echo $layanan_edit->LeftColumnClass ?>"><?php echo $layanan->Judul->caption() ?><?php echo ($layanan->Judul->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $layanan_edit->RightColumnClass ?>"><div<?php echo $layanan->Judul->cellAttributes() ?>>
<span id="el_layanan_Judul">
<input type="text" data-table="layanan" data-field="x_Judul" name="x_Judul" id="x_Judul" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($layanan->Judul->getPlaceHolder()) ?>" value="<?php echo $layanan->Judul->EditValue ?>"<?php echo $layanan->Judul->editAttributes() ?>>
</span>
<?php echo $layanan->Judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($layanan->Gambar->Visible) { // Gambar ?>
	<div id="r_Gambar" class="form-group row">
		<label id="elh_layanan_Gambar" class="<?php echo $layanan_edit->LeftColumnClass ?>"><?php echo $layanan->Gambar->caption() ?><?php echo ($layanan->Gambar->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $layanan_edit->RightColumnClass ?>"><div<?php echo $layanan->Gambar->cellAttributes() ?>>
<span id="el_layanan_Gambar">
<div id="fd_x_Gambar">
<span title="<?php echo $layanan->Gambar->title() ? $layanan->Gambar->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($layanan->Gambar->ReadOnly || $layanan->Gambar->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="layanan" data-field="x_Gambar" name="x_Gambar" id="x_Gambar"<?php echo $layanan->Gambar->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Gambar" id= "fn_x_Gambar" value="<?php echo $layanan->Gambar->Upload->FileName ?>">
<?php if (Post("fa_x_Gambar") == "0") { ?>
<input type="hidden" name="fa_x_Gambar" id= "fa_x_Gambar" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Gambar" id= "fa_x_Gambar" value="1">
<?php } ?>
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
		<label id="elh_layanan_Isi" for="x_Isi" class="<?php echo $layanan_edit->LeftColumnClass ?>"><?php echo $layanan->Isi->caption() ?><?php echo ($layanan->Isi->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $layanan_edit->RightColumnClass ?>"><div<?php echo $layanan->Isi->cellAttributes() ?>>
<span id="el_layanan_Isi">
<textarea data-table="layanan" data-field="x_Isi" name="x_Isi" id="x_Isi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($layanan->Isi->getPlaceHolder()) ?>"<?php echo $layanan->Isi->editAttributes() ?>><?php echo $layanan->Isi->EditValue ?></textarea>
</span>
<?php echo $layanan->Isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="layanan" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($layanan->ID->CurrentValue) ?>">
<?php if (!$layanan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $layanan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $layanan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$layanan_edit->IsModal) { ?>
<?php if (!isset($layanan_edit->Pager)) $layanan_edit->Pager = new PrevNextPager($layanan_edit->StartRec, $layanan_edit->DisplayRecs, $layanan_edit->TotalRecs, $layanan_edit->AutoHidePager) ?>
<?php if ($layanan_edit->Pager->RecordCount > 0 && $layanan_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($layanan_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($layanan_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $layanan_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($layanan_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($layanan_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $layanan_edit->pageUrl() ?>start=<?php echo $layanan_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $layanan_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$layanan_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$layanan_edit->terminate();
?>