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
$kontak_delete = new kontak_delete();

// Run the page
$kontak_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fkontakdelete = currentForm = new ew.Form("fkontakdelete", "delete");

// Form_CustomValidate event
fkontakdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fkontakdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $kontak_delete->showPageHeader(); ?>
<?php
$kontak_delete->showMessage();
?>
<form name="fkontakdelete" id="fkontakdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($kontak_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $kontak_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kontak_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kontak->Nama->Visible) { // Nama ?>
		<th class="<?php echo $kontak->Nama->headerCellClass() ?>"><span id="elh_kontak_Nama" class="kontak_Nama"><?php echo $kontak->Nama->caption() ?></span></th>
<?php } ?>
<?php if ($kontak->_Email->Visible) { // Email ?>
		<th class="<?php echo $kontak->_Email->headerCellClass() ?>"><span id="elh_kontak__Email" class="kontak__Email"><?php echo $kontak->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($kontak->Judul->Visible) { // Judul ?>
		<th class="<?php echo $kontak->Judul->headerCellClass() ?>"><span id="elh_kontak_Judul" class="kontak_Judul"><?php echo $kontak->Judul->caption() ?></span></th>
<?php } ?>
<?php if ($kontak->Status->Visible) { // Status ?>
		<th class="<?php echo $kontak->Status->headerCellClass() ?>"><span id="elh_kontak_Status" class="kontak_Status"><?php echo $kontak->Status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kontak_delete->RecCnt = 0;
$i = 0;
while (!$kontak_delete->Recordset->EOF) {
	$kontak_delete->RecCnt++;
	$kontak_delete->RowCnt++;

	// Set row properties
	$kontak->resetAttributes();
	$kontak->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kontak_delete->loadRowValues($kontak_delete->Recordset);

	// Render row
	$kontak_delete->renderRow();
?>
	<tr<?php echo $kontak->rowAttributes() ?>>
<?php if ($kontak->Nama->Visible) { // Nama ?>
		<td<?php echo $kontak->Nama->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCnt ?>_kontak_Nama" class="kontak_Nama">
<span<?php echo $kontak->Nama->viewAttributes() ?>>
<?php echo $kontak->Nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak->_Email->Visible) { // Email ?>
		<td<?php echo $kontak->_Email->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCnt ?>_kontak__Email" class="kontak__Email">
<span<?php echo $kontak->_Email->viewAttributes() ?>>
<?php echo $kontak->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak->Judul->Visible) { // Judul ?>
		<td<?php echo $kontak->Judul->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCnt ?>_kontak_Judul" class="kontak_Judul">
<span<?php echo $kontak->Judul->viewAttributes() ?>>
<?php echo $kontak->Judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak->Status->Visible) { // Status ?>
		<td<?php echo $kontak->Status->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCnt ?>_kontak_Status" class="kontak_Status">
<span<?php echo $kontak->Status->viewAttributes() ?>>
<?php echo $kontak->Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kontak_delete->Recordset->moveNext();
}
$kontak_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kontak_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kontak_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$kontak_delete->terminate();
?>