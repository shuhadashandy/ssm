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
$layanan_delete = new layanan_delete();

// Run the page
$layanan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$layanan_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var flayanandelete = currentForm = new ew.Form("flayanandelete", "delete");

// Form_CustomValidate event
flayanandelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flayanandelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $layanan_delete->showPageHeader(); ?>
<?php
$layanan_delete->showMessage();
?>
<form name="flayanandelete" id="flayanandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($layanan_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $layanan_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="layanan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($layanan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($layanan->Judul->Visible) { // Judul ?>
		<th class="<?php echo $layanan->Judul->headerCellClass() ?>"><span id="elh_layanan_Judul" class="layanan_Judul"><?php echo $layanan->Judul->caption() ?></span></th>
<?php } ?>
<?php if ($layanan->Gambar->Visible) { // Gambar ?>
		<th class="<?php echo $layanan->Gambar->headerCellClass() ?>"><span id="elh_layanan_Gambar" class="layanan_Gambar"><?php echo $layanan->Gambar->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$layanan_delete->RecCnt = 0;
$i = 0;
while (!$layanan_delete->Recordset->EOF) {
	$layanan_delete->RecCnt++;
	$layanan_delete->RowCnt++;

	// Set row properties
	$layanan->resetAttributes();
	$layanan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$layanan_delete->loadRowValues($layanan_delete->Recordset);

	// Render row
	$layanan_delete->renderRow();
?>
	<tr<?php echo $layanan->rowAttributes() ?>>
<?php if ($layanan->Judul->Visible) { // Judul ?>
		<td<?php echo $layanan->Judul->cellAttributes() ?>>
<span id="el<?php echo $layanan_delete->RowCnt ?>_layanan_Judul" class="layanan_Judul">
<span<?php echo $layanan->Judul->viewAttributes() ?>>
<?php echo $layanan->Judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($layanan->Gambar->Visible) { // Gambar ?>
		<td<?php echo $layanan->Gambar->cellAttributes() ?>>
<span id="el<?php echo $layanan_delete->RowCnt ?>_layanan_Gambar" class="layanan_Gambar">
<span>
<?php echo GetFileViewTag($layanan->Gambar, $layanan->Gambar->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$layanan_delete->Recordset->moveNext();
}
$layanan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $layanan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$layanan_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$layanan_delete->terminate();
?>