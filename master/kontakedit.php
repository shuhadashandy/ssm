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
$kontak_edit = new kontak_edit();

// Run the page
$kontak_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fkontakedit = currentForm = new ew.Form("fkontakedit", "edit");

// Validate form
fkontakedit.validate = function() {
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
		<?php if ($kontak_edit->Nama->Required) { ?>
			elm = this.getElements("x" + infix + "_Nama");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak->Nama->caption(), $kontak->Nama->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($kontak_edit->_Email->Required) { ?>
			elm = this.getElements("x" + infix + "__Email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak->_Email->caption(), $kontak->_Email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($kontak_edit->Judul->Required) { ?>
			elm = this.getElements("x" + infix + "_Judul");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak->Judul->caption(), $kontak->Judul->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($kontak_edit->Isi->Required) { ?>
			elm = this.getElements("x" + infix + "_Isi");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak->Isi->caption(), $kontak->Isi->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($kontak_edit->Status->Required) { ?>
			elm = this.getElements("x" + infix + "_Status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak->Status->caption(), $kontak->Status->RequiredErrorMessage)) ?>");
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
fkontakedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fkontakedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $kontak_edit->showPageHeader(); ?>
<?php
$kontak_edit->showMessage();
?>
<?php if (!$kontak_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($kontak_edit->Pager)) $kontak_edit->Pager = new PrevNextPager($kontak_edit->StartRec, $kontak_edit->DisplayRecs, $kontak_edit->TotalRecs, $kontak_edit->AutoHidePager) ?>
<?php if ($kontak_edit->Pager->RecordCount > 0 && $kontak_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($kontak_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($kontak_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $kontak_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($kontak_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($kontak_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $kontak_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fkontakedit" id="fkontakedit" class="<?php echo $kontak_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($kontak_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $kontak_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kontak_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($kontak->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group row">
		<label id="elh_kontak_Nama" for="x_Nama" class="<?php echo $kontak_edit->LeftColumnClass ?>"><?php echo $kontak->Nama->caption() ?><?php echo ($kontak->Nama->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_edit->RightColumnClass ?>"><div<?php echo $kontak->Nama->cellAttributes() ?>>
<span id="el_kontak_Nama">
<input type="text" data-table="kontak" data-field="x_Nama" name="x_Nama" id="x_Nama" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($kontak->Nama->getPlaceHolder()) ?>" value="<?php echo $kontak->Nama->EditValue ?>"<?php echo $kontak->Nama->editAttributes() ?>>
</span>
<?php echo $kontak->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_kontak__Email" for="x__Email" class="<?php echo $kontak_edit->LeftColumnClass ?>"><?php echo $kontak->_Email->caption() ?><?php echo ($kontak->_Email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_edit->RightColumnClass ?>"><div<?php echo $kontak->_Email->cellAttributes() ?>>
<span id="el_kontak__Email">
<input type="text" data-table="kontak" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($kontak->_Email->getPlaceHolder()) ?>" value="<?php echo $kontak->_Email->EditValue ?>"<?php echo $kontak->_Email->editAttributes() ?>>
</span>
<?php echo $kontak->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak->Judul->Visible) { // Judul ?>
	<div id="r_Judul" class="form-group row">
		<label id="elh_kontak_Judul" for="x_Judul" class="<?php echo $kontak_edit->LeftColumnClass ?>"><?php echo $kontak->Judul->caption() ?><?php echo ($kontak->Judul->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_edit->RightColumnClass ?>"><div<?php echo $kontak->Judul->cellAttributes() ?>>
<span id="el_kontak_Judul">
<input type="text" data-table="kontak" data-field="x_Judul" name="x_Judul" id="x_Judul" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($kontak->Judul->getPlaceHolder()) ?>" value="<?php echo $kontak->Judul->EditValue ?>"<?php echo $kontak->Judul->editAttributes() ?>>
</span>
<?php echo $kontak->Judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak->Isi->Visible) { // Isi ?>
	<div id="r_Isi" class="form-group row">
		<label id="elh_kontak_Isi" for="x_Isi" class="<?php echo $kontak_edit->LeftColumnClass ?>"><?php echo $kontak->Isi->caption() ?><?php echo ($kontak->Isi->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_edit->RightColumnClass ?>"><div<?php echo $kontak->Isi->cellAttributes() ?>>
<span id="el_kontak_Isi">
<textarea data-table="kontak" data-field="x_Isi" name="x_Isi" id="x_Isi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($kontak->Isi->getPlaceHolder()) ?>"<?php echo $kontak->Isi->editAttributes() ?>><?php echo $kontak->Isi->EditValue ?></textarea>
</span>
<?php echo $kontak->Isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_kontak_Status" for="x_Status" class="<?php echo $kontak_edit->LeftColumnClass ?>"><?php echo $kontak->Status->caption() ?><?php echo ($kontak->Status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_edit->RightColumnClass ?>"><div<?php echo $kontak->Status->cellAttributes() ?>>
<span id="el_kontak_Status">
<input type="text" data-table="kontak" data-field="x_Status" name="x_Status" id="x_Status" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($kontak->Status->getPlaceHolder()) ?>" value="<?php echo $kontak->Status->EditValue ?>"<?php echo $kontak->Status->editAttributes() ?>>
</span>
<?php echo $kontak->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="kontak" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($kontak->id->CurrentValue) ?>">
<?php if (!$kontak_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kontak_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kontak_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$kontak_edit->IsModal) { ?>
<?php if (!isset($kontak_edit->Pager)) $kontak_edit->Pager = new PrevNextPager($kontak_edit->StartRec, $kontak_edit->DisplayRecs, $kontak_edit->TotalRecs, $kontak_edit->AutoHidePager) ?>
<?php if ($kontak_edit->Pager->RecordCount > 0 && $kontak_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($kontak_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($kontak_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $kontak_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($kontak_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($kontak_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $kontak_edit->pageUrl() ?>start=<?php echo $kontak_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $kontak_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$kontak_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$kontak_edit->terminate();
?>