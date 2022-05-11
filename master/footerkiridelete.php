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
$footerkiri_delete = new footerkiri_delete();

// Run the page
$footerkiri_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$footerkiri_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ffooterkiridelete = currentForm = new ew.Form("ffooterkiridelete", "delete");

// Form_CustomValidate event
ffooterkiridelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffooterkiridelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $footerkiri_delete->showPageHeader(); ?>
<?php
$footerkiri_delete->showMessage();
?>
<form name="ffooterkiridelete" id="ffooterkiridelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($footerkiri_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $footerkiri_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="footerkiri">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($footerkiri_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($footerkiri->Judul->Visible) { // Judul ?>
		<th class="<?php echo $footerkiri->Judul->headerCellClass() ?>"><span id="elh_footerkiri_Judul" class="footerkiri_Judul"><?php echo $footerkiri->Judul->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->Isi->Visible) { // Isi ?>
		<th class="<?php echo $footerkiri->Isi->headerCellClass() ?>"><span id="elh_footerkiri_Isi" class="footerkiri_Isi"><?php echo $footerkiri->Isi->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->Isi2->Visible) { // Isi2 ?>
		<th class="<?php echo $footerkiri->Isi2->headerCellClass() ?>"><span id="elh_footerkiri_Isi2" class="footerkiri_Isi2"><?php echo $footerkiri->Isi2->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->Phone->Visible) { // Phone ?>
		<th class="<?php echo $footerkiri->Phone->headerCellClass() ?>"><span id="elh_footerkiri_Phone" class="footerkiri_Phone"><?php echo $footerkiri->Phone->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->_Email->Visible) { // Email ?>
		<th class="<?php echo $footerkiri->_Email->headerCellClass() ?>"><span id="elh_footerkiri__Email" class="footerkiri__Email"><?php echo $footerkiri->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->Twitter->Visible) { // Twitter ?>
		<th class="<?php echo $footerkiri->Twitter->headerCellClass() ?>"><span id="elh_footerkiri_Twitter" class="footerkiri_Twitter"><?php echo $footerkiri->Twitter->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->Facebook->Visible) { // Facebook ?>
		<th class="<?php echo $footerkiri->Facebook->headerCellClass() ?>"><span id="elh_footerkiri_Facebook" class="footerkiri_Facebook"><?php echo $footerkiri->Facebook->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->Instagram->Visible) { // Instagram ?>
		<th class="<?php echo $footerkiri->Instagram->headerCellClass() ?>"><span id="elh_footerkiri_Instagram" class="footerkiri_Instagram"><?php echo $footerkiri->Instagram->caption() ?></span></th>
<?php } ?>
<?php if ($footerkiri->LinkedIn->Visible) { // LinkedIn ?>
		<th class="<?php echo $footerkiri->LinkedIn->headerCellClass() ?>"><span id="elh_footerkiri_LinkedIn" class="footerkiri_LinkedIn"><?php echo $footerkiri->LinkedIn->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$footerkiri_delete->RecCnt = 0;
$i = 0;
while (!$footerkiri_delete->Recordset->EOF) {
	$footerkiri_delete->RecCnt++;
	$footerkiri_delete->RowCnt++;

	// Set row properties
	$footerkiri->resetAttributes();
	$footerkiri->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$footerkiri_delete->loadRowValues($footerkiri_delete->Recordset);

	// Render row
	$footerkiri_delete->renderRow();
?>
	<tr<?php echo $footerkiri->rowAttributes() ?>>
<?php if ($footerkiri->Judul->Visible) { // Judul ?>
		<td<?php echo $footerkiri->Judul->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_Judul" class="footerkiri_Judul">
<span<?php echo $footerkiri->Judul->viewAttributes() ?>>
<?php echo $footerkiri->Judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->Isi->Visible) { // Isi ?>
		<td<?php echo $footerkiri->Isi->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_Isi" class="footerkiri_Isi">
<span<?php echo $footerkiri->Isi->viewAttributes() ?>>
<?php echo $footerkiri->Isi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->Isi2->Visible) { // Isi2 ?>
		<td<?php echo $footerkiri->Isi2->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_Isi2" class="footerkiri_Isi2">
<span<?php echo $footerkiri->Isi2->viewAttributes() ?>>
<?php echo $footerkiri->Isi2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->Phone->Visible) { // Phone ?>
		<td<?php echo $footerkiri->Phone->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_Phone" class="footerkiri_Phone">
<span<?php echo $footerkiri->Phone->viewAttributes() ?>>
<?php echo $footerkiri->Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->_Email->Visible) { // Email ?>
		<td<?php echo $footerkiri->_Email->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri__Email" class="footerkiri__Email">
<span<?php echo $footerkiri->_Email->viewAttributes() ?>>
<?php echo $footerkiri->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->Twitter->Visible) { // Twitter ?>
		<td<?php echo $footerkiri->Twitter->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_Twitter" class="footerkiri_Twitter">
<span<?php echo $footerkiri->Twitter->viewAttributes() ?>>
<?php echo $footerkiri->Twitter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->Facebook->Visible) { // Facebook ?>
		<td<?php echo $footerkiri->Facebook->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_Facebook" class="footerkiri_Facebook">
<span<?php echo $footerkiri->Facebook->viewAttributes() ?>>
<?php echo $footerkiri->Facebook->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->Instagram->Visible) { // Instagram ?>
		<td<?php echo $footerkiri->Instagram->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_Instagram" class="footerkiri_Instagram">
<span<?php echo $footerkiri->Instagram->viewAttributes() ?>>
<?php echo $footerkiri->Instagram->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($footerkiri->LinkedIn->Visible) { // LinkedIn ?>
		<td<?php echo $footerkiri->LinkedIn->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_delete->RowCnt ?>_footerkiri_LinkedIn" class="footerkiri_LinkedIn">
<span<?php echo $footerkiri->LinkedIn->viewAttributes() ?>>
<?php echo $footerkiri->LinkedIn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$footerkiri_delete->Recordset->moveNext();
}
$footerkiri_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $footerkiri_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$footerkiri_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$footerkiri_delete->terminate();
?>