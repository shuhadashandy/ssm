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
$tentang_delete = new tentang_delete();

// Run the page
$tentang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tentang_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftentangdelete = currentForm = new ew.Form("ftentangdelete", "delete");

// Form_CustomValidate event
ftentangdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftentangdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tentang_delete->showPageHeader(); ?>
<?php
$tentang_delete->showMessage();
?>
<form name="ftentangdelete" id="ftentangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tentang_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tentang_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tentang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tentang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tentang->Judul->Visible) { // Judul ?>
		<th class="<?php echo $tentang->Judul->headerCellClass() ?>"><span id="elh_tentang_Judul" class="tentang_Judul"><?php echo $tentang->Judul->caption() ?></span></th>
<?php } ?>
<?php if ($tentang->Gambar->Visible) { // Gambar ?>
		<th class="<?php echo $tentang->Gambar->headerCellClass() ?>"><span id="elh_tentang_Gambar" class="tentang_Gambar"><?php echo $tentang->Gambar->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tentang_delete->RecCnt = 0;
$i = 0;
while (!$tentang_delete->Recordset->EOF) {
	$tentang_delete->RecCnt++;
	$tentang_delete->RowCnt++;

	// Set row properties
	$tentang->resetAttributes();
	$tentang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tentang_delete->loadRowValues($tentang_delete->Recordset);

	// Render row
	$tentang_delete->renderRow();
?>
	<tr<?php echo $tentang->rowAttributes() ?>>
<?php if ($tentang->Judul->Visible) { // Judul ?>
		<td<?php echo $tentang->Judul->cellAttributes() ?>>
<span id="el<?php echo $tentang_delete->RowCnt ?>_tentang_Judul" class="tentang_Judul">
<span<?php echo $tentang->Judul->viewAttributes() ?>>
<?php echo $tentang->Judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tentang->Gambar->Visible) { // Gambar ?>
		<td<?php echo $tentang->Gambar->cellAttributes() ?>>
<span id="el<?php echo $tentang_delete->RowCnt ?>_tentang_Gambar" class="tentang_Gambar">
<span>
<?php echo GetFileViewTag($tentang->Gambar, $tentang->Gambar->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tentang_delete->Recordset->moveNext();
}
$tentang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tentang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tentang_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tentang_delete->terminate();
?>