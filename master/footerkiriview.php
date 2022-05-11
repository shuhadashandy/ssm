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
$footerkiri_view = new footerkiri_view();

// Run the page
$footerkiri_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$footerkiri_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$footerkiri->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ffooterkiriview = currentForm = new ew.Form("ffooterkiriview", "view");

// Form_CustomValidate event
ffooterkiriview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffooterkiriview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$footerkiri->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $footerkiri_view->ExportOptions->render("body") ?>
<?php $footerkiri_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $footerkiri_view->showPageHeader(); ?>
<?php
$footerkiri_view->showMessage();
?>
<?php if (!$footerkiri_view->IsModal) { ?>
<?php if (!$footerkiri->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($footerkiri_view->Pager)) $footerkiri_view->Pager = new PrevNextPager($footerkiri_view->StartRec, $footerkiri_view->DisplayRecs, $footerkiri_view->TotalRecs, $footerkiri_view->AutoHidePager) ?>
<?php if ($footerkiri_view->Pager->RecordCount > 0 && $footerkiri_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($footerkiri_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($footerkiri_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $footerkiri_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($footerkiri_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($footerkiri_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $footerkiri_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ffooterkiriview" id="ffooterkiriview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($footerkiri_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $footerkiri_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="footerkiri">
<input type="hidden" name="modal" value="<?php echo (int)$footerkiri_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($footerkiri->Judul->Visible) { // Judul ?>
	<tr id="r_Judul">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_Judul"><?php echo $footerkiri->Judul->caption() ?></span></td>
		<td data-name="Judul"<?php echo $footerkiri->Judul->cellAttributes() ?>>
<span id="el_footerkiri_Judul">
<span<?php echo $footerkiri->Judul->viewAttributes() ?>>
<?php echo $footerkiri->Judul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->Isi->Visible) { // Isi ?>
	<tr id="r_Isi">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_Isi"><?php echo $footerkiri->Isi->caption() ?></span></td>
		<td data-name="Isi"<?php echo $footerkiri->Isi->cellAttributes() ?>>
<span id="el_footerkiri_Isi">
<span<?php echo $footerkiri->Isi->viewAttributes() ?>>
<?php echo $footerkiri->Isi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->Isi2->Visible) { // Isi2 ?>
	<tr id="r_Isi2">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_Isi2"><?php echo $footerkiri->Isi2->caption() ?></span></td>
		<td data-name="Isi2"<?php echo $footerkiri->Isi2->cellAttributes() ?>>
<span id="el_footerkiri_Isi2">
<span<?php echo $footerkiri->Isi2->viewAttributes() ?>>
<?php echo $footerkiri->Isi2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_Phone"><?php echo $footerkiri->Phone->caption() ?></span></td>
		<td data-name="Phone"<?php echo $footerkiri->Phone->cellAttributes() ?>>
<span id="el_footerkiri_Phone">
<span<?php echo $footerkiri->Phone->viewAttributes() ?>>
<?php echo $footerkiri->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri__Email"><?php echo $footerkiri->_Email->caption() ?></span></td>
		<td data-name="_Email"<?php echo $footerkiri->_Email->cellAttributes() ?>>
<span id="el_footerkiri__Email">
<span<?php echo $footerkiri->_Email->viewAttributes() ?>>
<?php echo $footerkiri->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->Twitter->Visible) { // Twitter ?>
	<tr id="r_Twitter">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_Twitter"><?php echo $footerkiri->Twitter->caption() ?></span></td>
		<td data-name="Twitter"<?php echo $footerkiri->Twitter->cellAttributes() ?>>
<span id="el_footerkiri_Twitter">
<span<?php echo $footerkiri->Twitter->viewAttributes() ?>>
<?php echo $footerkiri->Twitter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->Facebook->Visible) { // Facebook ?>
	<tr id="r_Facebook">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_Facebook"><?php echo $footerkiri->Facebook->caption() ?></span></td>
		<td data-name="Facebook"<?php echo $footerkiri->Facebook->cellAttributes() ?>>
<span id="el_footerkiri_Facebook">
<span<?php echo $footerkiri->Facebook->viewAttributes() ?>>
<?php echo $footerkiri->Facebook->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->Instagram->Visible) { // Instagram ?>
	<tr id="r_Instagram">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_Instagram"><?php echo $footerkiri->Instagram->caption() ?></span></td>
		<td data-name="Instagram"<?php echo $footerkiri->Instagram->cellAttributes() ?>>
<span id="el_footerkiri_Instagram">
<span<?php echo $footerkiri->Instagram->viewAttributes() ?>>
<?php echo $footerkiri->Instagram->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($footerkiri->LinkedIn->Visible) { // LinkedIn ?>
	<tr id="r_LinkedIn">
		<td class="<?php echo $footerkiri_view->TableLeftColumnClass ?>"><span id="elh_footerkiri_LinkedIn"><?php echo $footerkiri->LinkedIn->caption() ?></span></td>
		<td data-name="LinkedIn"<?php echo $footerkiri->LinkedIn->cellAttributes() ?>>
<span id="el_footerkiri_LinkedIn">
<span<?php echo $footerkiri->LinkedIn->viewAttributes() ?>>
<?php echo $footerkiri->LinkedIn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$footerkiri_view->IsModal) { ?>
<?php if (!$footerkiri->isExport()) { ?>
<?php if (!isset($footerkiri_view->Pager)) $footerkiri_view->Pager = new PrevNextPager($footerkiri_view->StartRec, $footerkiri_view->DisplayRecs, $footerkiri_view->TotalRecs, $footerkiri_view->AutoHidePager) ?>
<?php if ($footerkiri_view->Pager->RecordCount > 0 && $footerkiri_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($footerkiri_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($footerkiri_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $footerkiri_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($footerkiri_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($footerkiri_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $footerkiri_view->pageUrl() ?>start=<?php echo $footerkiri_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $footerkiri_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$footerkiri_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$footerkiri->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$footerkiri_view->terminate();
?>