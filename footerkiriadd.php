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
$footerkiri_add = new footerkiri_add();

// Run the page
$footerkiri_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$footerkiri_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ffooterkiriadd = currentForm = new ew.Form("ffooterkiriadd", "add");

// Validate form
ffooterkiriadd.validate = function() {
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
		<?php if ($footerkiri_add->Judul->Required) { ?>
			elm = this.getElements("x" + infix + "_Judul");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->Judul->caption(), $footerkiri->Judul->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->Isi->Required) { ?>
			elm = this.getElements("x" + infix + "_Isi");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->Isi->caption(), $footerkiri->Isi->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->Isi2->Required) { ?>
			elm = this.getElements("x" + infix + "_Isi2");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->Isi2->caption(), $footerkiri->Isi2->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->Phone->Required) { ?>
			elm = this.getElements("x" + infix + "_Phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->Phone->caption(), $footerkiri->Phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->_Email->Required) { ?>
			elm = this.getElements("x" + infix + "__Email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->_Email->caption(), $footerkiri->_Email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->Twitter->Required) { ?>
			elm = this.getElements("x" + infix + "_Twitter");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->Twitter->caption(), $footerkiri->Twitter->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->Facebook->Required) { ?>
			elm = this.getElements("x" + infix + "_Facebook");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->Facebook->caption(), $footerkiri->Facebook->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->Instagram->Required) { ?>
			elm = this.getElements("x" + infix + "_Instagram");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->Instagram->caption(), $footerkiri->Instagram->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($footerkiri_add->LinkedIn->Required) { ?>
			elm = this.getElements("x" + infix + "_LinkedIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $footerkiri->LinkedIn->caption(), $footerkiri->LinkedIn->RequiredErrorMessage)) ?>");
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
ffooterkiriadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffooterkiriadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $footerkiri_add->showPageHeader(); ?>
<?php
$footerkiri_add->showMessage();
?>
<form name="ffooterkiriadd" id="ffooterkiriadd" class="<?php echo $footerkiri_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($footerkiri_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $footerkiri_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="footerkiri">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$footerkiri_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($footerkiri->Judul->Visible) { // Judul ?>
	<div id="r_Judul" class="form-group row">
		<label id="elh_footerkiri_Judul" for="x_Judul" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->Judul->caption() ?><?php echo ($footerkiri->Judul->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->Judul->cellAttributes() ?>>
<span id="el_footerkiri_Judul">
<input type="text" data-table="footerkiri" data-field="x_Judul" name="x_Judul" id="x_Judul" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($footerkiri->Judul->getPlaceHolder()) ?>" value="<?php echo $footerkiri->Judul->EditValue ?>"<?php echo $footerkiri->Judul->editAttributes() ?>>
</span>
<?php echo $footerkiri->Judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->Isi->Visible) { // Isi ?>
	<div id="r_Isi" class="form-group row">
		<label id="elh_footerkiri_Isi" for="x_Isi" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->Isi->caption() ?><?php echo ($footerkiri->Isi->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->Isi->cellAttributes() ?>>
<span id="el_footerkiri_Isi">
<input type="text" data-table="footerkiri" data-field="x_Isi" name="x_Isi" id="x_Isi" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($footerkiri->Isi->getPlaceHolder()) ?>" value="<?php echo $footerkiri->Isi->EditValue ?>"<?php echo $footerkiri->Isi->editAttributes() ?>>
</span>
<?php echo $footerkiri->Isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->Isi2->Visible) { // Isi2 ?>
	<div id="r_Isi2" class="form-group row">
		<label id="elh_footerkiri_Isi2" for="x_Isi2" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->Isi2->caption() ?><?php echo ($footerkiri->Isi2->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->Isi2->cellAttributes() ?>>
<span id="el_footerkiri_Isi2">
<input type="text" data-table="footerkiri" data-field="x_Isi2" name="x_Isi2" id="x_Isi2" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($footerkiri->Isi2->getPlaceHolder()) ?>" value="<?php echo $footerkiri->Isi2->EditValue ?>"<?php echo $footerkiri->Isi2->editAttributes() ?>>
</span>
<?php echo $footerkiri->Isi2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->Phone->Visible) { // Phone ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_footerkiri_Phone" for="x_Phone" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->Phone->caption() ?><?php echo ($footerkiri->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->Phone->cellAttributes() ?>>
<span id="el_footerkiri_Phone">
<input type="text" data-table="footerkiri" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($footerkiri->Phone->getPlaceHolder()) ?>" value="<?php echo $footerkiri->Phone->EditValue ?>"<?php echo $footerkiri->Phone->editAttributes() ?>>
</span>
<?php echo $footerkiri->Phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_footerkiri__Email" for="x__Email" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->_Email->caption() ?><?php echo ($footerkiri->_Email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->_Email->cellAttributes() ?>>
<span id="el_footerkiri__Email">
<input type="text" data-table="footerkiri" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($footerkiri->_Email->getPlaceHolder()) ?>" value="<?php echo $footerkiri->_Email->EditValue ?>"<?php echo $footerkiri->_Email->editAttributes() ?>>
</span>
<?php echo $footerkiri->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->Twitter->Visible) { // Twitter ?>
	<div id="r_Twitter" class="form-group row">
		<label id="elh_footerkiri_Twitter" for="x_Twitter" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->Twitter->caption() ?><?php echo ($footerkiri->Twitter->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->Twitter->cellAttributes() ?>>
<span id="el_footerkiri_Twitter">
<input type="text" data-table="footerkiri" data-field="x_Twitter" name="x_Twitter" id="x_Twitter" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($footerkiri->Twitter->getPlaceHolder()) ?>" value="<?php echo $footerkiri->Twitter->EditValue ?>"<?php echo $footerkiri->Twitter->editAttributes() ?>>
</span>
<?php echo $footerkiri->Twitter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->Facebook->Visible) { // Facebook ?>
	<div id="r_Facebook" class="form-group row">
		<label id="elh_footerkiri_Facebook" for="x_Facebook" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->Facebook->caption() ?><?php echo ($footerkiri->Facebook->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->Facebook->cellAttributes() ?>>
<span id="el_footerkiri_Facebook">
<input type="text" data-table="footerkiri" data-field="x_Facebook" name="x_Facebook" id="x_Facebook" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($footerkiri->Facebook->getPlaceHolder()) ?>" value="<?php echo $footerkiri->Facebook->EditValue ?>"<?php echo $footerkiri->Facebook->editAttributes() ?>>
</span>
<?php echo $footerkiri->Facebook->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->Instagram->Visible) { // Instagram ?>
	<div id="r_Instagram" class="form-group row">
		<label id="elh_footerkiri_Instagram" for="x_Instagram" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->Instagram->caption() ?><?php echo ($footerkiri->Instagram->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->Instagram->cellAttributes() ?>>
<span id="el_footerkiri_Instagram">
<input type="text" data-table="footerkiri" data-field="x_Instagram" name="x_Instagram" id="x_Instagram" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($footerkiri->Instagram->getPlaceHolder()) ?>" value="<?php echo $footerkiri->Instagram->EditValue ?>"<?php echo $footerkiri->Instagram->editAttributes() ?>>
</span>
<?php echo $footerkiri->Instagram->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($footerkiri->LinkedIn->Visible) { // LinkedIn ?>
	<div id="r_LinkedIn" class="form-group row">
		<label id="elh_footerkiri_LinkedIn" for="x_LinkedIn" class="<?php echo $footerkiri_add->LeftColumnClass ?>"><?php echo $footerkiri->LinkedIn->caption() ?><?php echo ($footerkiri->LinkedIn->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $footerkiri_add->RightColumnClass ?>"><div<?php echo $footerkiri->LinkedIn->cellAttributes() ?>>
<span id="el_footerkiri_LinkedIn">
<input type="text" data-table="footerkiri" data-field="x_LinkedIn" name="x_LinkedIn" id="x_LinkedIn" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($footerkiri->LinkedIn->getPlaceHolder()) ?>" value="<?php echo $footerkiri->LinkedIn->EditValue ?>"<?php echo $footerkiri->LinkedIn->editAttributes() ?>>
</span>
<?php echo $footerkiri->LinkedIn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$footerkiri_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $footerkiri_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $footerkiri_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$footerkiri_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$footerkiri_add->terminate();
?>