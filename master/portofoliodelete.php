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
$portofolio_delete = new portofolio_delete();

// Run the page
$portofolio_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portofolio_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fportofoliodelete = currentForm = new ew.Form("fportofoliodelete", "delete");

// Form_CustomValidate event
fportofoliodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportofoliodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $portofolio_delete->showPageHeader(); ?>
<?php
$portofolio_delete->showMessage();
?>
<form name="fportofoliodelete" id="fportofoliodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portofolio_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portofolio_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portofolio">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($portofolio_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($portofolio->Judul->Visible) { // Judul ?>
		<th class="<?php echo $portofolio->Judul->headerCellClass() ?>"><span id="elh_portofolio_Judul" class="portofolio_Judul"><?php echo $portofolio->Judul->caption() ?></span></th>
<?php } ?>
<?php if ($portofolio->Gambar->Visible) { // Gambar ?>
		<th class="<?php echo $portofolio->Gambar->headerCellClass() ?>"><span id="elh_portofolio_Gambar" class="portofolio_Gambar"><?php echo $portofolio->Gambar->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$portofolio_delete->RecCnt = 0;
$i = 0;
while (!$portofolio_delete->Recordset->EOF) {
	$portofolio_delete->RecCnt++;
	$portofolio_delete->RowCnt++;

	// Set row properties
	$portofolio->resetAttributes();
	$portofolio->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$portofolio_delete->loadRowValues($portofolio_delete->Recordset);

	// Render row
	$portofolio_delete->renderRow();
?>
	<tr<?php echo $portofolio->rowAttributes() ?>>
<?php if ($portofolio->Judul->Visible) { // Judul ?>
		<td<?php echo $portofolio->Judul->cellAttributes() ?>>
<span id="el<?php echo $portofolio_delete->RowCnt ?>_portofolio_Judul" class="portofolio_Judul">
<span<?php echo $portofolio->Judul->viewAttributes() ?>>
<?php echo $portofolio->Judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($portofolio->Gambar->Visible) { // Gambar ?>
		<td<?php echo $portofolio->Gambar->cellAttributes() ?>>
<span id="el<?php echo $portofolio_delete->RowCnt ?>_portofolio_Gambar" class="portofolio_Gambar">
<span>
<?php echo GetFileViewTag($portofolio->Gambar, $portofolio->Gambar->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$portofolio_delete->Recordset->moveNext();
}
$portofolio_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $portofolio_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$portofolio_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$portofolio_delete->terminate();
?>