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
$portofolio_edit = new portofolio_edit();

// Run the page
$portofolio_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portofolio_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fportofolioedit = currentForm = new ew.Form("fportofolioedit", "edit");

// Validate form
fportofolioedit.validate = function() {
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
		<?php if ($portofolio_edit->Judul->Required) { ?>
			elm = this.getElements("x" + infix + "_Judul");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $portofolio->Judul->caption(), $portofolio->Judul->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($portofolio_edit->Isi->Required) { ?>
			elm = this.getElements("x" + infix + "_Isi");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $portofolio->Isi->caption(), $portofolio->Isi->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($portofolio_edit->Gambar->Required) { ?>
			felm = this.getElements("x" + infix + "_Gambar");
			elm = this.getElements("fn_x" + infix + "_Gambar");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $portofolio->Gambar->caption(), $portofolio->Gambar->RequiredErrorMessage)) ?>");
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
fportofolioedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportofolioedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $portofolio_edit->showPageHeader(); ?>
<?php
$portofolio_edit->showMessage();
?>
<?php if (!$portofolio_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($portofolio_edit->Pager)) $portofolio_edit->Pager = new PrevNextPager($portofolio_edit->StartRec, $portofolio_edit->DisplayRecs, $portofolio_edit->TotalRecs, $portofolio_edit->AutoHidePager) ?>
<?php if ($portofolio_edit->Pager->RecordCount > 0 && $portofolio_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portofolio_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portofolio_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portofolio_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portofolio_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portofolio_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portofolio_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fportofolioedit" id="fportofolioedit" class="<?php echo $portofolio_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portofolio_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portofolio_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portofolio">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$portofolio_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($portofolio->Judul->Visible) { // Judul ?>
	<div id="r_Judul" class="form-group row">
		<label id="elh_portofolio_Judul" for="x_Judul" class="<?php echo $portofolio_edit->LeftColumnClass ?>"><?php echo $portofolio->Judul->caption() ?><?php echo ($portofolio->Judul->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $portofolio_edit->RightColumnClass ?>"><div<?php echo $portofolio->Judul->cellAttributes() ?>>
<span id="el_portofolio_Judul">
<input type="text" data-table="portofolio" data-field="x_Judul" name="x_Judul" id="x_Judul" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($portofolio->Judul->getPlaceHolder()) ?>" value="<?php echo $portofolio->Judul->EditValue ?>"<?php echo $portofolio->Judul->editAttributes() ?>>
</span>
<?php echo $portofolio->Judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($portofolio->Isi->Visible) { // Isi ?>
	<div id="r_Isi" class="form-group row">
		<label id="elh_portofolio_Isi" for="x_Isi" class="<?php echo $portofolio_edit->LeftColumnClass ?>"><?php echo $portofolio->Isi->caption() ?><?php echo ($portofolio->Isi->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $portofolio_edit->RightColumnClass ?>"><div<?php echo $portofolio->Isi->cellAttributes() ?>>
<span id="el_portofolio_Isi">
<textarea data-table="portofolio" data-field="x_Isi" name="x_Isi" id="x_Isi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($portofolio->Isi->getPlaceHolder()) ?>"<?php echo $portofolio->Isi->editAttributes() ?>><?php echo $portofolio->Isi->EditValue ?></textarea>
</span>
<?php echo $portofolio->Isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($portofolio->Gambar->Visible) { // Gambar ?>
	<div id="r_Gambar" class="form-group row">
		<label id="elh_portofolio_Gambar" class="<?php echo $portofolio_edit->LeftColumnClass ?>"><?php echo $portofolio->Gambar->caption() ?><?php echo ($portofolio->Gambar->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $portofolio_edit->RightColumnClass ?>"><div<?php echo $portofolio->Gambar->cellAttributes() ?>>
<span id="el_portofolio_Gambar">
<div id="fd_x_Gambar">
<span title="<?php echo $portofolio->Gambar->title() ? $portofolio->Gambar->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($portofolio->Gambar->ReadOnly || $portofolio->Gambar->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="portofolio" data-field="x_Gambar" name="x_Gambar" id="x_Gambar"<?php echo $portofolio->Gambar->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Gambar" id= "fn_x_Gambar" value="<?php echo $portofolio->Gambar->Upload->FileName ?>">
<?php if (Post("fa_x_Gambar") == "0") { ?>
<input type="hidden" name="fa_x_Gambar" id= "fa_x_Gambar" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Gambar" id= "fa_x_Gambar" value="1">
<?php } ?>
<input type="hidden" name="fs_x_Gambar" id= "fs_x_Gambar" value="50">
<input type="hidden" name="fx_x_Gambar" id= "fx_x_Gambar" value="<?php echo $portofolio->Gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Gambar" id= "fm_x_Gambar" value="<?php echo $portofolio->Gambar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Gambar" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $portofolio->Gambar->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="portofolio" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($portofolio->ID->CurrentValue) ?>">
<?php if (!$portofolio_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $portofolio_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $portofolio_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$portofolio_edit->IsModal) { ?>
<?php if (!isset($portofolio_edit->Pager)) $portofolio_edit->Pager = new PrevNextPager($portofolio_edit->StartRec, $portofolio_edit->DisplayRecs, $portofolio_edit->TotalRecs, $portofolio_edit->AutoHidePager) ?>
<?php if ($portofolio_edit->Pager->RecordCount > 0 && $portofolio_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portofolio_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portofolio_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portofolio_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portofolio_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portofolio_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portofolio_edit->pageUrl() ?>start=<?php echo $portofolio_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portofolio_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$portofolio_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$portofolio_edit->terminate();
?>